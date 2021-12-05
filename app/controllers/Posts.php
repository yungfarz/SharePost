<?php

Class Posts extends app\Controller{


    public function __construct()
    {
        if(!isLoggedin()){
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        $posts = $this->postModel->getPosts();

      $data = [

           'posts' => $posts
        ];

        

        $this->view('posts/index', $data);

    }

    public function add()
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            

            //Sanitize POST array

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


               $data = 
               [

                  'title'     => trim($_POST['title']),
                  'body'      => trim($_POST['body']),
                  'user_id'   => $_SESSION['user_id'],
                  'title_err' => '',
                  'body_err'  => ''

                ];

        //Validate data

        if(empty($data['title'])){

            $data['title_err'] = 'Please enter title';
        }

        if(empty($data['body'])){
            $data['body_err'] = 'Please enter body text';
        }

        // Make sure no errors

        if(empty($data['title_err']) && empty($data['body_err'])){

            //Validated

            if($this->postModel->addPost($data)){
                flash('post_message','Post Added');
                redirect('posts');

            }
            else{
             die('Something went wrong');
            }
          

        
        }
        else {
          //Load view with errors
          $this->view('posts/add', $data);
        }





        }
        else
        {

            
         $data = [

           'title' => '',
           'body'  => ''
        ];

         $this->view('posts/add', $data);

        }

    }

    public function show($id){

       $post = $this->postModel->getPostById($id);
       $user = $this->userModel->getUserById($post->user_id);


       $data = 
       [
         
           'post' => $post,
           'user' => $user

       ];


        $this->view('posts/show', $data);
    }

    public function showPosters(){

            if(isset($_POST['action']) && $_POST['action'] == "view"){
                
             $out_put = '';
             $data = $this->postModel ->showPosters();

             if($this->postModel->rowCount()){
                 $out_put .= '  <table class="table table-striped table-bordered text-center" id="tablestyle">

                      <thead>

                           <tr>
                        
                               <th>Name</th>
                               <th>Email</th>
                               <th>Created</th>
                           </tr>


                      </thead>
                      <tbody>
                 ';

                  foreach($data as $row){
                     $out_put .= ' 

                         <tr>

                            <td>'.$row->name.'</td>    
                            <td>'.$row->email.'</td>
                            <td>'.$row->created_at.'</td>
                          


                         </tr>
                     
                     ';

                   
                  }

                    $out_put .= '</tbody></table>';
                     echo $out_put;

            }

        
         
    }
  
      $this->view('posts/posters', $data);
 
}


}