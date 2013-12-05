<?php



Class Team extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        if (checkLogin() == true)
        {
            $arrContents["strTitle"] = "HomeCare Team";
            $arrContents["arrHeader"] = array();
            $strActiveMenu = "team";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $this->load->model("Team_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
        }
        else
        {load_controller('start');}
    }
    
    
}
?>
