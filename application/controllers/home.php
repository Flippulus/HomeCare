<?php

class Home extends CI_Controller
{

    function index()
    {
        session_start();
        date_default_timezone_set("Europe/Brussels");
        connect_database();
        
        if (checkLogin() == true)
        {
            $strActiveMenu = "home";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();

            $arrContents["strTitle"] = "HomeCare";
            $arrContents["arrHeader"] = array();

            $this->load->model("Home_Model", "objModel");
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }

}
