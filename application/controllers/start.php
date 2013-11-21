<?php

/*
 * HomeCare home controller
 */

class Start extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        //Correct timezone (Brussels)
        
        
        $result = authentication();
        if($result === true)
        {
            //Check if logged on
            $blnLoggedOn = checkLogin();
            $this -> load -> model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
            $this -> load -> model("Home_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $arrContents["strContents"] = $this -> objModel -> getPageData($arrMainMenuItems, $blnLoggedOn);
        }
        else
        {
            if($result == "notset")
            {
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $arrContents["strContents"] = $this -> objModel -> getPageData();
            }
            else
            {
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $arrContents["strContents"] = $this -> objModel -> getPageData($arrMainMenuItems, $result);
            }
        }
        //Assigning the contents to the view, by getting them from the model
        $this -> load -> view("index_view", $arrContents);
    }
}