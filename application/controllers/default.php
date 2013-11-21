<?php

/*
 * HomeCare home controller
 */

class Default_Controller extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        
        $result = authentication();
        if($result === true)
        {
            createPageStart("HomeCare", array());
            //Check if logged on
            $blnLoggedOn = checkLogin();
            $this -> load -> model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
            $this -> load -> model("Home_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $this -> view -> assign("strContents", $this -> objModel -> getPageData($arrMainMenuItems, $blnLoggedOn));
        }
        else
        {
            if($result == "notset")
            {
                createPageStart("HomeCare", array("login" => "css"));
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Default_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $this -> view -> assign("strContents", $this -> objModel -> getPageData());
            }
            else
            {
                createPageStart("HomeCare", array("login" => "css"));
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Default_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $this -> view -> assign("strContents", $this -> objModel -> getErrorData($arrMainMenuItems, $result));
            }
        }
        //Assigning the contents to the view, by getting them from the model
        $this -> view -> display("index_view");
    }
}

?>