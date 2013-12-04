<?php

class Clienten extends CI_Controller
{
    function index()
    {
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
        }
        else
        {load_controller('start');}
    }
}
?>
