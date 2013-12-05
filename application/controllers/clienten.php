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
            $strActiveMenu = "clienten";
            $arrContents["strTitle"] = "Clienten";
            $arrContents["arrHeader"] = array();
            
            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Clienten_Model", "objModel");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this->objModel->getClientData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }
}
?>
