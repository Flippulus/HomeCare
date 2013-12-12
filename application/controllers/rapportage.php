<?php

class Rapportage extends CI_Controller
{

    function index()
    {
        //Runs script connecting to the Database
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();

        if (checkLogin() == true)
        {
            //Load model
            $strActiveMenu = "rapportage";
            $arrContents["strTitle"] = "Rapportages";
            $arrContents["arrHeader"] = array("textarea" => "js", "rapportage" => "css");

            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Rapportage_Model", "objRapportage");

            //Get model data
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            
            if(isset($_POST['frmSubmitReport']))
            {                
                post_report($_POST['report_content'], $_SESSION['userid']);
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu);
            }
            elseif(isset($_POST['frmEditReport']))
            {                
                Update_report($_POST['update_content'], $_GET['report_id']);
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu);
            }
            elseif(isset($_GET['report_id']))
            {
                $strId= $_GET['report_id'];
                $arrContents["strContents"] = $this->objRapportage->updateReportData($arrMainMenuItems, $strActiveMenu, $strId);
            }
            
            else
            {
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu);
            }
            

            //Display view
            //$this->view->display('index_view');
            $this->load->view("index_view", $arrContents);
        }
        else
        {
            load_controller('start');
        }
    }

}

?>
