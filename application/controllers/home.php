<?php

class Home extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        $blnLoggedOn = checkLogin();
        //HIER MOET IK FAILSAFE OP MAKEN
        
        $strActiveMenu = "home";
        $this -> load -> model("MenuItems_Model", "objMenuItems");
        $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
        
        $arrContents["strTitle"] = "HomeCare";
        $arrContents["arrHeader"] = array();
        
        $this -> load -> model("Home_Model", "objModel");
        //Loading the model so the page contents can be created and given to the view
        $arrContents["strContents"] = $this -> objModel -> getPageData($arrMainMenuItems, $strActiveMenu);
        //Assigning the contents to the view, by getting them from the model
        $this -> load -> view("index_view", $arrContents);
    }
}
