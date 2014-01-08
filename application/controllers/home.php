<?php

class Home extends CI_Controller
{

    function index()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        date_default_timezone_set("Europe/Brussels");
        session_save_path(dirname('tmp/'));
        session_start();
        connect_database();
        
        if (checkLogin() == true)
        {
            
            $arrContents["strTitle"] = "HomeCare";
            $arrContents["arrHeader"] = array('showHide'=>'js', 'team'=>'css', 'table' => 'css');
            $strActiveMenu = "home";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $this->load->model("Home_Model", "objModel");
            
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {header("Location: http://www.rimiclacihomecare.co.nf");}
    }

}
