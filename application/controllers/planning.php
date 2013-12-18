<?php

class Planning extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();

        if (checkLogin() == true)
        {
            $arrContents["strTitle"] = "HomeCare planning";
            $arrContents["arrHeader"] = array("planning" => "css", "table" => "css", "showHide" => "js");
            $strActiveMenu = "planning";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            if(isset($_GET["view"]))
            {$strActiveSubMenu = $_GET["view"];}
            else
            {$strActiveSubMenu = "day";}
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrSubMenuItems = $this->objMenuItems->getSubMenuItems("planning");
            $this->load->model("Planning_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }
}