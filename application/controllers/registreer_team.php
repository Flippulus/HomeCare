<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class Registreer_team extends CI_Controller
{
    
      function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_save_path(dirname('tmp/'));
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        if (checkLogin() == true)
        {
            $arrContents["strTitle"] = "HomeCare Registreer Team";
            $arrContents["arrHeader"] = array('showHide'=>'js', 'team'=>'css', 'table' => 'css');
            $strActiveMenu = "team";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems('team');    
            $this->load->model("Registreer_team_model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            if(isset($_POST["frmAddUser"]))
            {$arrContents["strContents"] = $this->objModel->getRegisterData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'register');}
            else
            {$arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'register');}
            $this->load->view("index_view", $arrContents);
            
            
        }
        else
        {header("Location: http://localhost:8080/meet2eat/index.php");}
    }
    
    
}