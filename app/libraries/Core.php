<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/param
*/

namespace app;

//App Core class
Class Core {

         
    protected $currentController = 'Pages';
    protected $currentMethod     = 'index';
    protected $params            = [];





    public function __construct(){
           $url = $this->getUrl();

           // Look in Controllers for first value
           if(isset($url[0]) && file_exists('../app/controllers/'. ucwords($url[0]) . '.php'))
           {
              // If exist, set as controller
            $this->currentController  = ucwords($url[0]);
            //Unset 0 Index
            unset($url[0]);


           }
        
           //Require the controller class
           require_once '../app/controllers/' . $this->currentController . '.php';

           //Instatiate controller class
           $this->currentController = new $this->currentController;

           //Check for second part of url
           if(isset($url[1])){
             //check to see if the method exist in controller
             if(method_exists($this->currentController, $url[1])){

              $this->currentMethod = $url[1];
              //unset 1 index
              unset($url[1]);

             }
           }

           // Get params

           $this->params = $url ? array_values($url) : [];

           //Call a callback with array of params
           call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

  //Gets URL
    public function getUrl(){
            
         if(isset($_GET['url'])){
            //Trim URL
            $url = rtrim($_GET['url'], '/');
            //Filter and Sanitize URL
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //Explodes URL
            $url = explode('/', $url);
            return $url;
         }

    }


}
