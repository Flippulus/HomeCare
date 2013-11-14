<?php

class Rapportage_Controller extends TinyMVC_Controller {

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
        $Reportdata = $this->objRapportage->getReportData($arrMainMenuItems, $blnLoggedOn);
        //Assign to view
        //$this->view->assign("strContents", $this->objRapportage->getPageData($arrMainMenuItems, $blnLoggedOn));
        $this->view->assign('strContents', $Reportdata);

        //Display view
        $this->view->display('index_view');

        
        
    }

}

?>
