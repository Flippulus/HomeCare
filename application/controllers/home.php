<?php

class Home_Controller extends TinyMVC_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        createPageStart("HomeCare", array());
        
        authentication();
        
        $this -> load -> model("MenuItems_Model", "objMenuItems");
        $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
        $this -> load -> model("Home_Model", "objModel");
        //Loading the model so the page contents can be created and given to the view
        $this -> view -> assign("strContents", $this -> objModel -> getPageData($arrMainMenuItems));
        //Assigning the contents to the view, by getting them from the model
        $this -> view -> display("index_view");
    }
}
