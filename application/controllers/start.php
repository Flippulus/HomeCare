<?php

/*
 * HomeCare home controller
 */

class Start extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        echo date("d/m/Y H:i");
        
        $this -> load -> library("login");
        $this -> load -> library("htmlhelpers");
        
        $result = $this -> login -> authentication();
        if($result === true)
        {
            $this -> htmlhelpers -> createPageStart("HomeCare", array());
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
                $this -> htmlhelpers -> createPageStart("HomeCare", array("login" => "css"));
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $this -> view -> assign("strContents", $this -> objModel -> getPageData());
            }
            else
            {
                $this -> htmlhelpers -> createPageStart("HomeCare", array("login" => "css"));
                $this -> load -> model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
                $this -> load -> model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $this -> view -> assign("strContents", $this -> objModel -> getErrorData($arrMainMenuItems, $result));
            }
        }
        //Assigning the contents to the view, by getting them from the model
        $this -> view -> display("index_view");
    }
}

?>