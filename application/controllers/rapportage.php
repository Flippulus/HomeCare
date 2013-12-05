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
            $arrContents["arrHeader"] = array("textarea" => "js");

            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Rapportage_Model", "objRapportage");

            //Get model data

            if(isset($_POST['frmSubmitReport']))
            {                
                post_report("1", $_POST['report_content'], $_SESSION['userid']);
                $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
                $arrContents["strContents"] = $this->objRapportage->getReportData($arrMainMenuItems, $strActiveMenu);
            }
            else
            {
                $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
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
