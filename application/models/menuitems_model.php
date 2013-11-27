<?php

/*
 * 
 * PHP version 5
 * 
 * @Package accountanting
 * @Author Philippe Dirx <philippedirx@hotmail.com>
 * @Copyright 2013
 * @License
 * 
 * 
 * This file is property of Philippe Dirx.
 * This file is not meant to be used by others then Philippe Dirx or his assigners.
 * This file is created for the sole purpose of supporting the company of ThreeS, property of Rudi op 't Roodt, Boy Smeets and Roné Kirkels
 * 
 * 
 * Using tinyMVC structure: Model <- Controller -> View
 * This is a model, called on every page, to return all the contents of the menubar.
 */

class MenuItems_Model extends CI_Model
{
    function getMainMenuItems()
    {
        $arrMainMenuItems = array(
            "Home" => array(
                "name" => "Home",//Phil
                "controller" => "home"
            ),
            "Planning" => array(
                "name" => "Planning",//Phil
                "controller" => "planning"
            ),
            "Rapportage" => array(
                "name" => "Rapportage",//Rob
                "controller" => "rapportage"
            ),
            "Cliënten" => array(
                "name" => "Cliënten",//Rob
                "controller" => "clienten"
            ),
            "Documenten" => array(
                "name" => "Documenten",//Kenneth
                "controller" => "documenten"
            ),
            "Team" => array(
                "name" => "Team",//Kenneth
                "controller" => "team"
            ),
            
        );
        
        return $arrMainMenuItems;
    }
}


?>