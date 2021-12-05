<?php
 /*
 *Base Controller
 * Loads the models and views
 */
 
 namespace app;
 class Controller {
    // Load model
    public function model($model)
    {
      //Reqiure model file
        require_once '../app/models/'. $model. '.php';


      //Instatiate model file
         return new $model();
    }


    // Load view
    public function view($view, $data = [])
    {
       // Check for view file
       if(file_exists('../app/views/' . $view . '.php'))
        {
          //Reqiure view file
          require_once '../app/views/' . $view . '.php';
        }
       else
        {
           //View does not exist
           die("View does not exist");
        }
    }

 }