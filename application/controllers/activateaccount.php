<?php


Class ActivateAccount extends CI_Controller 
{
    
      function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_save_path(dirname('tmp/'));
        session_start();
        connect_database();
        //Runs script connecting to the Database
        if(isset($_GET["id"]))
        {
            $arrContents["strTitle"] = "HomeCare Account";
            $arrContents["arrHeader"] = array('showHide'=>'js', 'table' => 'css');
            $this->load->model("ActivateAccount_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            
            $arrContents["strContents"] = $this -> objModel -> getPageData();
            
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller("start");}
    }
    
    
    
}