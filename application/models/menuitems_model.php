<?php

class MenuItems_Model extends CI_Model
{

    function getMainMenuItems()
    {
        $arrMainMenuItems = array(
            "Home" => array(
                "name" => "Home", //Phil
                "controller" => "home"
            ),
            "Planning" => array(
                "name" => "Planning", //Phil
                "controller" => "planning"
            ),
            "Rapportage" => array(
                "name" => "Rapportage", //Rob
                "controller" => "rapportage"
            ),
            "Cliënten" => array(
                "name" => "Cliënten", //Rob
                "controller" => "clienten"
            ),
            "Documenten" => array(
                "name" => "Documenten", //Kenneth
                "controller" => "documenten"
            ),
            "Team" => array(
                "name" => "Team", //Kenneth
                "controller" => "team"
            ),
        );

        return $arrMainMenuItems;
    }

    function getSubMenuItems($strPage)
    {
        switch ($strPage)
        {
            case "planning":
                $arrMainMenuItems = array(
                    "dag" => array(
                        "name" => "Dag",
                        "controller" => "planning?view=day"
                    ),
                    "week" => array(
                        "name" => "Week",
                        "controller" => "planning?view=week"
                    ),
                );
                break;
            case "team":
                $arrMainMenuItems = array(
                    "team" => array(
                        "name" => "Team",
                        "controller" => "team"
                    ),
                    "register" => array(
                        "name" => "Registreer",
                        "controller" => "register"
                    ),
                    "account" => array(
                        "name" => "Account",
                        "controller" => "account"
                    ),
                );
                break;
        }

        return $arrMainMenuItems;
    }

}

?>