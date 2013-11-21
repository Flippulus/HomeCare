<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Documenten_Controller extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        
        //Check if logged on
        $blnLoggedOn = checkLogin();
        if($blnLoggedOn == true)
        {
            createPageStart("HomeCare", array());
            $this -> load -> model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
            $this -> load -> model("Documenten_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $this -> view -> assign("strContents", $this -> objModel -> getPageData($arrMainMenuItems, $blnLoggedOn));
        }
        else
        {
            $this -> load -> model("NoEntry_Model", "objError");
            $this -> view -> assign("strContents", $this -> objError -> getPageData());
        }
        $this -> view -> display("index_view");
    }
    
}
?>
