<?php

Class Planning_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body>";
        
        $arrDate = getPlanningDate();
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= getCalendar($arrDate["day"], $arrDate["month"], $arrDate["year"], $arrDate["phpdate"]);
        
        if(date("Y/m/d") == $arrDate["phpdate"])
        {
            $strYesterday = "<< Gisteren";
            $strToday = "Vandaag";
            $strTomorrow = "Morgen >>";
        }
        else
        {
            $strYesterday = "<< Eerder";
            $strToday = $arrDate["normaldate"];
            $strTomorrow = "Later >>";
        }
        
        $strContents .= "
            <div class = \"homecaretable\" style = \"margin-top:5%;\">
                <table>
                    <thead>
                        <tr>
                            <td>
                                <a href = \"/index.php/planning?day=".($arrDate["day"]-1)."&month=".$arrDate["month"]."&year=".$arrDate["year"]."\">
                                    $strYesterday
                                </a>
                            </td>
                            <td>
                                $strToday 
                                <mark style = \"background-color: transparent; cursor: pointer;\"
                                      onclick = \"goToLink('/index.php/planning?action=add&day=".$arrDate["day"]."&month=".$arrDate["month"]."&year=".$arrDate["year"]."')\">
                                    Planning toevoegen</mark>
                            </td>
                            <td>
                                <a href = \"/index.php/planning?day=".($arrDate["day"]+1)."&month=".$arrDate["month"]."&year=".$arrDate["year"]."\">
                                    $strTomorrow
                                </a>
                            </td>
                        </tr>
                    </thead>
                </table>";
        
        $strContents .= getPartialPlanning($arrDate, 0);
        $strContents .= getPartialPlanning($arrDate, 1);
        $strContents .= getPartialPlanning($arrDate, 2);
        
        $strContents .= build_footer();

        return $strContents;
    }
    
    function getNewPlanningData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body>";
        
        $result = getDataBaseData("clients");
        $strJs = "
                <script>
                    var arrClients = [";
        
        while($arrClientData = mysql_fetch_assoc($result))
        {
            $strId = $arrClientData["client_id"];
            $strFirstName = $arrClientData["client_firstname"];
            $strLastName = $arrClientData["client_lastname"];
            $strJs .= "[$strId, '$strFirstName', '$strLastName'],";
        }
        
        $strJs .= "
                    ];
                </script>";
        
        $arrDate = getPlanningDate();
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= getCalendar($arrDate["day"], $arrDate["month"], $arrDate["year"], $arrDate["phpdate"]);
        
        $strContents .= "
            <div class = \"homecaretable\" style = \"margin-top:5%;\">
                <form method = \"post\">
                    <table>
                        <thead>
                            <tr>
                                <td colspan = 2>
                                    Planning toevoegen
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Verantwoordelijke verpleegkundige:
                                </td>
                                <td>
                                    <select name = \"user\">
                                        <option value = \"na\">Kies...</option>";
        $userResult = getDataBaseData("users");
        while($arrUserData = mysql_fetch_assoc($userResult))
        {
            $strContents .= "
                                        <option value = \"".$arrUserData["user_id"]."\">
                                            ".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."
                                        </option>";
        }
        $strContents .= "
                                    </select>
                                </td>
                            </tr>
                            <tr id = \"planning_0\">
                                <td>
                                    Deel van de dag:
                                </td>
                                <td>
                                    <select name = \"timeOfDay\" id = \"timeOfDay\" required>
                                        <option value = \"na\">Kies...</option>
                                        <option value = \"0\">Ochtend</option>
                                        <option value = \"1\">Middag</option>
                                        <option value = \"2\">Avond</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan = 2>
                                    <textarea name = \"notes\" style = \"resize: none;\" cols = 80 rows = 6></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark style = \"background-color: transparent; cursor: pointer;\"
                                      onclick = \"addItem();\">
                                    Klik voor nieuw item</mark>
                                </td>
                                <td>
                                    <input type = \"submit\" name = \"frmPlanning\" value = \"Sla planning op\">
                                </td>
                        </tbody>
                    </table>
                </form>
            </div>";
        
        $strContents .= build_footer();
        $strContents .= $strJs;

        return $strContents;
    }
}
