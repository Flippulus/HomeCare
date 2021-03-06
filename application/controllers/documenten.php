<?php

class Documenten extends CI_Controller
{

    function index()
    {
        error_reporting(E_ERROR);
        setlocale(LC_ALL, 'nl_BE');
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
            {uploadFile("general");}
            if(isset($_GET["action"]) && $_GET["action"] == "delete")
            {removeFile($_GET["id"]);}
            if(isset($_POST["frmNewMap"]) && $_POST["newMapName"] != "")
            {addMap($_POST["newMapName"]);}
            if(isset($_GET["action"]) && $_GET["action"] == "removemap")
            {deleteMap($_GET["id"]);}
            
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {
            header("Location: http://www.rimiclacihomecare.co.nf");
        }
        
    }

}