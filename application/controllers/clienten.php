<?php

class Clienten extends CI_Controller
{
    function index()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        setlocale(LC_ALL, 'nl_BE');
        session_save_path(dirname('tmp/'));
        session_start();
        date_default_timezone_set("Europe/Brussels");
        connect_database();
        
        if (checkLogin() == true)
        {
            $strActiveMenu = "clienten";
            if(isset($_GET["client"]))
            {$strActiveSubMenu = $_GET["client"];}
            else
            {$strActiveSubMenu = "client";}
            
            $arrContents["strTitle"] = "Clienten";
            
            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Clienten_Model", "objClienten");
            $this->load->model("Rapportage_Model", "objRapportage");
            $this->load->model("MenuItems_Model", "objMenuItems");
            
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems("clienten");
            
            //Loading the model so the page contents can be created and given to the view
            
            if(isset($_POST['frmAddClient'])) //Event that adds new clients to the database
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js", "documenten" => "css", "docs_js" => "js");
                
                $strActiveSubMenu="client";
                add_client($_POST['firstName'],$_POST['lastName'],$_POST['dateOfBirth'],$_POST['sex'],$_POST['civilState'],$_POST['partnerName'],$_POST['civilNumber'],$_POST['healtcareNumber'],$_POST['location'],$_POST['postal'],$_POST['street'],$_POST['number'],$_POST['mailbox'],$_POST['phone'],$_POST['cell'],$_POST['doctor'],$_POST['apothecary'],$_POST['dateInCare'],$_POST['respUser'],$_POST['familyData'],$_POST['indication'],$_POST['indicationDesc'],$_POST['anamnese'],$_POST['medication'],$_POST['extra']);
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_POST['frmEditClient'])) //Event that sends the edited data to the database
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js");
                
                $strId= $_GET['edit_client'];
                Update_client($_POST['firstName'],$_POST['lastName'],$_POST['dateOfBirth'],$_POST['sex'],$_POST['civilState'],$_POST['partnerName'],$_POST['civilNumber'],$_POST['healtcareNumber'],$_POST['location'],$_POST['postal'],$_POST['street'],$_POST['number'],$_POST['mailbox'],$_POST['phone'],$_POST['cell'],$_POST['doctor'],$_POST['apothecary'],$_POST['dateInCare'],$_POST['respUser'],$_POST['familyData'],$_POST['indication'],$_POST['indicationDesc'],$_POST['anamnese'],$_POST['medication'],$_POST['extra'],$strId);
                $arrContents["strContents"] = $this->objClienten->getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_POST['frmEditReport'])) //Event that sends the edited report to the database
            {                
                $arrContents["arrHeader"] = array("rapportage" => "css", "table"=>"css",
                                                    "textarea" => "js", "tablePagination"=>"js");
                
                Update_report($_POST['report_update'], $_GET['report_id']);
                $strId= $_GET['client_report'];
                $arrContents["strContents"] = $this->objClienten->getReportData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu,$strId);
            }
            elseif(isset($_POST['frmSubmitClientReport']))//Event that adds a new report about a client to the database
            {                
                $arrContents["arrHeader"] = array("rapportage" => "css", "table"=>"css", 
                                                    "textarea" => "js", "tablePagination"=>"js");
                
                post_report($_POST['report_content'],$_SESSION['userid'] ,$_GET['client_report']);
                $strId= $_GET['client_report'];
                $arrContents["strContents"] = $this->objClienten->getReportData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu,$strId);
            }
            elseif(isset($_GET['report_id']))//Event that shows the page where reports are edited
            {
                $arrContents["arrHeader"] = array("rapportage" => "css", "table"=>"css", 
                                                    "textarea" => "js", "tablePagination"=>"js");
                
                $strId= $_GET['report_id'];
                $arrContents["strContents"] = $this->objRapportage->updateReportData($arrMainMenuItems, $strActiveMenu, $strId, $arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['client_report']))//Event that shows the reports about the chosen client
            {
                $arrContents["arrHeader"] = array("rapportage" => "css", "table"=>"css", 
                                                    "textarea" => "js", "tablePagination"=>"js");
                
                $strId= $_GET['client_report'];
                $arrContents["strContents"] = $this->objClienten->getReportData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_GET['client_doc']))//Event that shows the documents about the chosen client
            {
                $arrContents["arrHeader"] = array("clienten" => "css", 
                                                    "docs_js" => "js" );
                
                $strId= $_GET['client_doc'];
                
                if (isset($_POST["frmFileUpload"]))
                {
                    uploadFile("clients", $strId);
                }
                $arrContents["strContents"] = $this->objClienten->getDocData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif((isset($_GET["client"]))&&($_GET["client"]=="Nieuw"))//Event that shows the page where new clients are added
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js");
                
                $arrContents["strContents"] = $this->objClienten->addUser($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['client_id']))//Event that shows all the client data about a chosen user
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js");
                
                $strId= $_GET['client_id'];
                $arrContents["strContents"] = $this->objClienten->getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_GET['edit_client']))//Event that shows the page where data about the clients can be edited
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js");
                
                $strId= $_GET['edit_client'];
                $arrContents["strContents"] = $this->objClienten->updateClient($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            else //Event that shows all the users and the links between their data, reports and documents
            {
                $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css",
                                                    "showHide"=>"js");
                
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            
            $this->load->view("index_view", $arrContents);
        }
        else
        {header("Location: http://www.rimiclacihomecare.co.nf");}
    }
}