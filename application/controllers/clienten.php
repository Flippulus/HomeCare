<?php

class Clienten extends CI_Controller
{
    function index()
    {
        session_start();
        date_default_timezone_set("Europe/Brussels");
        connect_database();
        
        if (checkLogin() == true)
        {
            $strActiveMenu = "clienten";
            if(isset($_GET["client"]))
            {$strActiveSubMenu = $_GET["client"];}
            else
            {$strActiveSubMenu = "client";}
            
            $arrContents["strTitle"] = "Clienten";
            $arrContents["arrHeader"] = array("table"=>"css","clienten"=>"css" , "showHide"=>"js");
            
            $this->load->model("MenuItems_Model", "objMenuItems");
            $this->load->model("Clienten_Model", "objClienten");
            
            $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
            $arrSubMenuItems = $this ->objMenuItems->getSubMenuItems("clienten");
            
            //Loading the model so the page contents can be created and given to the view
            if((isset($_GET["client"]))&&($_GET["client"]=="Nieuw"))
            {
                $arrContents["strContents"] = $this->objClienten->addUser($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_POST['frmAddClient']))
            {
                $strActiveSubMenu='client';
                
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            elseif(isset($_GET['client_id']))
            {
                $strId= $_GET['client_id'];
                $arrContents["strContents"] = $this->objClienten->getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            }
            elseif(isset($_GET['edit_client']))
            {
                $strId= $_GET['edit_client'];
                $arrContents["strContents"] = $this->objClienten->updateClient($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId);
            
            }
            else
            {
                $arrContents["strContents"] = $this->objClienten->showPages($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu);
            }
            
            $this->load->view("index_view", $arrContents);
        }
        else
        {load_controller('start');}
    }
}
?>
