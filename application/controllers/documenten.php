<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Documenten extends CI_Controller
{

    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();

        if (!isset($_POST["frmFileUpload"]))
        {
            $strActiveMenu = "documenten";
            $this->load->model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            
            //Variabelen voor header en titel
            $arrContents["strTitle"] = "Document uploaden";
            $arrContents["arrHeader"] = array();
            
            $this -> load -> model("Documenten_Model", "objModel");
            $arrContents["strContents"] = $this -> objModel -> getPageData($arrMainMenuItems, $strActiveMenu);
            $this -> load -> view("index_view", $arrContents);
        }
        else
        {
            
        }
    }

}

?>
