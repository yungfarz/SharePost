<?php

class Pages  extends app\Controller{

    public function __construct()
    {
     
       
    }

    public function index()
    {
           

        if(isLoggedin()){
            redirect('posts');
        }


       $data =  [
           'title'       => 'SharePost',
           'description' =>  'Simple social network built on the MyMvc Framework'
         
       ];

       $this->view('pages/index',$data);
    }

    public function about()
    {
      
         $data =  [
           'title'       => 'SharePost',
           'description' =>  'App to share posts with others'
         
       ];
    
        $this->view('pages/about', $data);
    
    }

     public function test()
    {
      
         $data =  [
           'title'       => 'SharePost',
           'description' =>  'App to share posts with others'
         
       ];
    
        $this->view('pages/test', $data);
    
    }



}


