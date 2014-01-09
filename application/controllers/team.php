<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Class Team extends CI_Controller
{
    function index()
    {
        error_reporting(E_ERROR);
        setlocale(LC_ALL, 'nl_BE');
        date_default_timezone_set("Europe/Brussels");
        session_save_path(dirname('tmp/'));
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        if (checkLogin() == true)
        {
            $arrContents["strTitle"] = "HomeCare Team";
            $arrContents["arrHeader"] = array('showHide'=>'js', 'team'=>'css', 'table' => 'css');
            $strActiveMenu = "team";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems('team');    
            $this->load->model("Team_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,'team');
            $this->load->view("index_view", $arrContents);
            
            
        }
        else
        {header("Location: http://www.rimiclacihomecare.co.nf");}
    }
    
    
}