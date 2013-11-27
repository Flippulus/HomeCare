<?php

class Rapportage extends CI_Controller {

    function index() {
        //Runs script connecting to the Database
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        

        createPageStart("HomeCare", array());

        //Check if logged on
        $blnLoggedOn = checkLogin();

        //Load model

        $this->load->model("MenuItems_Model", "objMenuItems");
        $this->load->model("Rapportage_Model", "objRapportage");

        //Get model data

        $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
        $arrContents = $this->objRapportage->getReportData($arrMainMenuItems, $blnLoggedOn);
        
        //Display view
        //$this->view->display('index_view');
        $this->load->view("index_view", $arrContents);

        
        
    }

}

?>
