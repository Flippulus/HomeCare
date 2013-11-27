<?php

class Documenten extends CI_Controller
{

    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();

        $strActiveMenu = "documenten";
        $this->load->model("MenuItems_Model", "objMenuItems");
        $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();

        if (!isset($_POST["frmFileUpload"]))
        {
            //Variabelen voor header en titel
            $arrContents["strTitle"] = "Document uploaden";
            $arrContents["arrHeader"] = array();

            $this->load->model("Documenten_Model", "objModel");
            $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
            $this->load->view("index_view", $arrContents);
        }
        else
        {
            echo $_FILES["userfile"]["name"];
            $this->load->library("upload", getUploadConfig("general", false));
            if ($this->upload->do_upload())
            {
                //Variabelen voor header en titel
                $arrContents["strTitle"] = "Document uploaden";
                $arrContents["arrHeader"] = array();

                $this->load->model("Documenten_Model", "objModel");
                $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
                $this->load->view("index_view", $arrContents);
            }
            else
            {
                echo $this -> upload -> display_errors();
                echo "Upload mislukt!";
                //Variabelen voor header en titel
                $arrContents["strTitle"] = "Document uploaden";
                $arrContents["arrHeader"] = array();

                $this->load->model("Documenten_Model", "objModel");
                $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
                $this->load->view("index_view", $arrContents);
            }
        }
    }

}

?>
