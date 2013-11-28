<?php

class Home extends CI_Controller
{

    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database

        if (checkLogin() == true)
        {
            $strActiveMenu = "home";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();

            $arrContents["strTitle"] = "HomeCare";
            $arrContents["arrHeader"] = array();

            $this->load->model("Home_Model", "objModel");
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            
        }
        else
        {
            $this->load->library('../controllers/start');
            $this -> start -> index();
        }
        $this->load->view("index_view", $arrContents);
    }

}
