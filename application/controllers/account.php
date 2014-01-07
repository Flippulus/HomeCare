<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */

Class Account extends CI_Controller 
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
            $arrContents["strTitle"] = "HomeCare Account";
            $arrContents["arrHeader"] = array('showHide'=>'js', 'team'=>'css', 'table' => 'css');
            $strActiveMenu = "team";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems('team');    
            $this->load->model("Account_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            
            if(isset($_POST['frmSaveAccount']))
            {
                changeAccountData();
                $arrContents["strContents"] = $this -> objModel -> getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'account');
            }
            elseif(isset($_GET['edit_account']))
            {
                 $arrContents["strContents"] = $this->objModel->getAdjustData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'account', $_GET['edit_account']);
            }
            else
            {
                $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'account');
            }
           
            $this->load->view("index_view", $arrContents);
            
            
        }
        else
        {header("Location: http://localhost:8080/meet2eat/index.php");}
    }
    
    
    
}