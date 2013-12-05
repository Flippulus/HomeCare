<?php

class Clienten extends CI_Controller
{
    function index()
    {
        session_start();
        date_default_timezone_set("Europe/Brussels");
        connect_database();
        
        if (checkLogin() == true)
        {
            $arrContents["strTitle"] = "HomeCare Clienten";
            $arrContents["arrHeader"] = array();
            $strActiveMenu = "planning";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $this->load->model("Clienten_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }
}
?>
