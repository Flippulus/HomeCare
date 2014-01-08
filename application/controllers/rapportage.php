<?php

class Rapportage extends CI_Controller
{

    function index()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        //Runs script connecting to the Database
        session_save_path(dirname('tmp/'));
        session_start();
        date_default_timezone_set("Europe/Brussels");
        
        connect_database();

        if (checkLogin() == true)
        {
            //Load model
            $strActiveMenu = "rapportage";
            
            
            $arrContents["strTitle"] = "Rapportages";
            $arrContents["arrHeader"] = array("textarea" => "js","tablePagination"=>"js" , "rapportage" => "css", "table"=>"css");

            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Rapportage_Model", "objRapportage");

            //Get model data
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems("Rapportage");
            
            
            if(isset($_GET["post"]))
            {$strActiveSubMenu = $_GET["post"];}
            else
            {$strActiveSubMenu = "Report";}
            
            
            if(isset($_POST['frmSubmitReport']))
            {                
                $strActiveSubMenu = "Report";
                post_report($_POST['report_content'], $_SESSION['userid']);
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_POST['frmEditReport']))
            {                
                Update_report($_POST['report_update'], $_GET['report_id']);
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['report_id']))
            {
                $strId= $_GET['report_id'];
                $arrContents["strContents"] = $this->objRapportage->updateReportData($arrMainMenuItems, $strActiveMenu, $strId, $arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET["post"])&&($_GET["post"]=="Nieuw"))
            {
                $arrContents["strContents"] = $this->objRapportage->build_inputArea($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            else
            {
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            
            

            //Display view
            //$this->view->display('index_view');
            $this->load->view("index_view", $arrContents);
        }
        else
        {
            header("Location: http://www.rimiclacihomecare.co.nf");
        }
    }

}