<?php

class Planning extends CI_Controller
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
            $arrContents["strTitle"] = "HomeCare planning";
            $arrContents["arrHeader"] = array("planning" => "css", "table" => "css", "showHide" => "js", "remover" => "js", "planningadder" => "js");
            $strActiveMenu = "planning";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            
            $this->load->model("Planning_Model", "objModel");
            
            if(isset($_GET["action"]))
            {
                if($_GET["action"] == "remove")
                {
                    deletePlanning();
                    $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
                }
                if($_GET["action"] == "add")
                {
                    if(isset($_POST["frmPlanning"]))
                    {
                        addPlanning();
                        $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
                    }
                    else
                    {$arrContents["strContents"] = $this->objModel->getNewPlanningData($arrMainMenuItems, $strActiveMenu);}
                }
            }
            else
            {$arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);}
            
            $this->load->view("index_view", $arrContents);
        }
        else
        {header("Location: http://www.rimiclacihomecare.co.nf");}
    }
}