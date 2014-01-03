<?php

class Clienten extends CI_Controller
{
    function index()
    {
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
            $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css", "rapportage" => "css", 
                                              "showHide"=>"js", "textarea" => "js","tablePagination"=>"js" );
            
            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Clienten_Model", "objClienten");
            $this->load->model("Rapportage_Model", "objRapportage");
            
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems("clienten");
            
            //Loading the model so the page contents can be created and given to the view
            
            if(isset($_POST['frmAddClient']))
            {
                $strActiveSubMenu="client";
                add_client($_POST['firstName'],$_POST['lastName'],$_POST['dateOfBirth'],$_POST['sex'],$_POST['civilState'],$_POST['partnerName'],$_POST['civilNumber'],$_POST['healtcareNumber'],$_POST['location'],$_POST['postal'],$_POST['street'],$_POST['number'],$_POST['mailbox'],$_POST['phone'],$_POST['cell'],$_POST['doctor'],$_POST['apothecary'],$_POST['dateInCare'],$_POST['respUser'],$_POST['familyData'],$_POST['indication'],$_POST['indicationDesc'],$_POST['anamnese'],$_POST['medication'],$_POST['extra']);
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_POST['frmEditClient']))
            {
                $strId= $_GET['edit_client'];
                Update_client($_POST['firstName'],$_POST['lastName'],$_POST['dateOfBirth'],$_POST['sex'],$_POST['civilState'],$_POST['partnerName'],$_POST['civilNumber'],$_POST['healtcareNumber'],$_POST['location'],$_POST['postal'],$_POST['street'],$_POST['number'],$_POST['mailbox'],$_POST['phone'],$_POST['cell'],$_POST['doctor'],$_POST['apothecary'],$_POST['dateInCare'],$_POST['respUser'],$_POST['familyData'],$_POST['indication'],$_POST['indicationDesc'],$_POST['anamnese'],$_POST['medication'],$_POST['extra'],$strId);
                $arrContents["strContents"] = $this->objClienten->getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_POST['frmEditReport']))
            {                
                Update_report($_POST['report_update'], $_GET['report_id']);
                $strId= $_GET['client_report'];
                $arrContents["strContents"] = $this->objClienten->getReportData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu,$strId);
            }
            elseif(isset($_GET['report_id']))
            {
                $strId= $_GET['report_id'];
                $arrContents["strContents"] = $this->objRapportage->updateReportData($arrMainMenuItems, $strActiveMenu, $strId, $arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['client_report']))
            {
                $strId= $_GET['client_report'];
                $arrContents["strContents"] = $this->objClienten->getReportData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif((isset($_GET["client"]))&&($_GET["client"]=="Nieuw"))
            {
                $arrContents["strContents"] = $this->objClienten->addUser($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['client_id']))
            {
                $strId= $_GET['client_id'];
                $arrContents["strContents"] = $this->objClienten->getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_GET['edit_client']))
            {
                $strId= $_GET['edit_client'];
                $arrContents["strContents"] = $this->objClienten->updateClient($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            else
            {
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }
}
?>
