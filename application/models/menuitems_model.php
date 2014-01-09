<?php

class MenuItems_Model extends CI_Model
{

    function getMainMenuItems()
    {
        $arrMainMenuItems = array(
            "Home" => array(
                "name" => "Home", 
                "controller" => "home"
            ),
            "Planning" => array(
                "name" => "Planning", 
                "controller" => "planning"
            ),
            "Rapportage" => array(
                "name" => "Rapportage",
                "controller" => "rapportage"
            ),
            "Cliënten" => array(
                "name" => "Cliënten",
                "controller" => "clienten"
            ),
            "Documenten" => array(
                "name" => "Documenten", 
                "controller" => "documenten"
            ),
            "Team" => array(
                "name" => "Team", 
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
                    "day" => array(
                        "name" => "Dag",
                        "controller" => "planning?view=day"
                    ),
                    "week" => array(
                        "name" => "Week",
                        "controller" => "planning?view=week"
                    ),
                );
                break;
            case "Rapportage":
                $arrMainMenuItems = array(
                    "Report" => array(
                        "name" => "Rapportage",
                        "controller" => "rapportage?post=Report"
                    ),
                    "Nieuw" => array(
                        "name" => "Voeg toe",
                        "controller" => "rapportage?post=Nieuw"
                    ),
                );
                break;
            case "clienten":
                $arrMainMenuItems = array(
                    "client" => array(
                        "name" => "Cliënt",
                        "controller" => "clienten?client=client"
                    ),
                    "Nieuw" => array(
                        "name" => "Registreer",
                        "controller" => "clienten?client=Nieuw"
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
                        "controller" => "registreer_team"
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