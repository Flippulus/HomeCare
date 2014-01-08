<?php



class Start extends CI_Controller
{

    function index()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        date_default_timezone_set("Europe/Brussels");
        if (session_id() == '')
        {session_save_path(dirname('tmp/'));session_start();}
        connect_database();

        $result = authentication();
        if ($result === true)
        {
            //only if user is logged in, can he/she come to this page
            if (checkLogin() == true)
            {
                $arrContents["strTitle"] = "HomeCare";
                $arrContents["arrHeader"] = array();
                $strActiveMenu = "home";
                $this->load->model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
                $this->load->model("Home_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $arrContents["strContents"] = $this->objModel->getPageData($arrMainMenuItems, $strActiveMenu);
                $this->load->view("index_view", $arrContents);
            }
            else
            {header("Location: http://www.rimiclacihomecare.co.nf");}
        }
        else
        {
            logoff();
            $arrContents["strTitle"] = "HomeCare Login";
            $arrContents["arrHeader"] = array("login" => "css", "logon" => "js");
            if ($result == "notset")
            {
                $this->load->model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
                $this->load->model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $arrContents["strContents"] = $this->objModel->getPageData();
                $this->load->view("index_view", $arrContents);
            }
            else
            {
                $this->load->model("MenuItems_Model", "objMenuItems");
                $arrMainMenuItems = $this->objMenuItems->getMainMenuItems();
                $this->load->model("Start_Model", "objModel");
                //Loading the model so the page contents can be created and given to the view
                $arrContents["strContents"] = $this->objModel->getErrorData($result);
                $this->load->view("index_view", $arrContents);
            }
        }
        
    }

}
