<?php

class Documenten extends CI_Controller
{

    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_save_path(dirname('tmp/'));
        session_start();
        connect_database();

        if (checkLogin() == true)
        {
            $strActiveMenu = "documenten";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            
            //Variabelen voor header en titel
            $arrContents["strTitle"] = "HomeCare Documenten";
            $arrContents["arrHeader"] = array("documenten" => "css", "docs_js" => "js");
            $this->load->model("Documenten_Model", "objModel");
            
            if (isset($_POST["frmFileUpload"]))
            {
                uploadFile("general");
            }
            
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {
            header("Location: www.rimiclacihomecare.co.nf");
        }
        
    }

}