<?php

Class Planning_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strContents = "
            </head>
            <body>";
        
        if(isset($_GET["day"]))
        {$strDay = $_GET["day"];}
        else
        {$strDay = date("d");}
        if(isset($_GET["month"]))
        {$strMonth = $_GET["month"];}
        else
        {$strMonth = date("m");}
        if(isset($_GET["year"]))
        {$strYear = $_GET["year"];}
        else
        {$strYear = date("Y");}
        
        $strPhpDate = "$strYear/$strMonth/$strDay";
        $strNormalDate = "$strDay/$strMonth/$strYear";
        
        $arrPrefs = getCalendarPrefs("day", $strDay);

        $this->load->library("calendar", $arrPrefs);
        $arrData = array();
        for ($i = 1; $i < 32; $i++)
        {$arrData[$i] = "?view=day&day=$i&month=$strMonth&year=$strYear";}
        
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= $this->calendar->generate(date("Y", strtotime($strPhpDate)), date("n", strtotime($strPhpDate)), $arrData);
        
        $result = getDataBaseData("planning", array("planning_date" => date("Y-m-d" , strtotime($strPhpDate))));
        
        if($result != false and $result != null)
        {
            $arrDayData = mysql_fetch_assoc($result);
            $arrUser1 = mysql_fetch_assoc(getDataBaseData("users", array("user_id" => $arrDayData["planning_morning_user"])));
            $arrUser2 = mysql_fetch_assoc(getDataBaseData("users", array("user_id" => $arrDayData["planning_noon_user"])));
            $arrUser3 = mysql_fetch_assoc(getDataBaseData("users", array("user_id" => $arrDayData["planning_evening_user"])));

            $arrPlanningMorning = getPlanning("morning", $arrDayData);

            $strContents .= "
                <div class = \"homecaretable\">
                    <table>
                        <thead>
                            <tr style = \"cursor:pointer; border-top: 1px solid black;\" onclick = \"showHide('planning_', 'morning');\">
                                <td colspan = 2>Ochtend: ".$arrUser1["user_firstname"]." ".$arrUser1["user_lastname"]."</td>
                            </tr>
                        <thead>
                        <tr class = \"planning_morning\" id = \"morning\" style = \"display:none;\"></tr>";

            foreach($arrPlanningMorning as $strTime => $strClient)
            {
                $arrClientData = mysql_fetch_assoc(getDataBaseData("clients", array("client_id" => intval($strClient))));
                $strContents .= "
                        <tr class = \"planning_morning\">
                            <td>".$strTime." => </td><td>".$arrClientData["client_firstname"]." ".$arrClientData["client_lastname"]."</td>
                        </tr>";
            }
            $strContents .= "
                    </table>";

            $arrPlanningNoon = getPlanning("noon", $arrDayData);

            $strContents .= "
                    <table>
                        <thead>
                            <tr style = \"cursor:pointer;border-top: 1px solid black;\" onclick = \"showHide('planning_', 'noon');\">
                                <td colspan = 2>Middag: ".$arrUser2["user_firstname"]." ".$arrUser2["user_lastname"]."</td>
                            </tr>
                        </thead>
                        <tr class = \"planning_noon\" id = \"noon\" style = \"display:none;\"></tr>";

            foreach($arrPlanningNoon as $strTime => $strClient)
            {
                $arrClientData = mysql_fetch_assoc(getDataBaseData("clients", array("client_id" => intval($strClient))));
                $strContents .= "
                        <tr class = \"planning_noon\">
                            <td>".$strTime." => </td><td>".$arrClientData["client_firstname"]." ".$arrClientData["client_lastname"]."</td>
                        </tr>";
            }
            $strContents .= "
                    </table>";

            $arrPlanningEvening = getPlanning("evening", $arrDayData);

            $strContents .= "
                    <table>
                        <thead>
                            <tr style = \"cursor:pointer; border-top: 1px solid black;\" onclick = \"showHide('planning_', 'evening');\">
                                <td colspan = 2>Avond: ".$arrUser3["user_firstname"]." ".$arrUser3["user_lastname"]."</td>
                            </tr>
                        </thead>
                        <tr class = \"planning_evening\" id = \"evening\" style = \"display:none;\"></tr>";

            foreach($arrPlanningEvening as $strTime => $strClient)
            {
                $arrClientData = mysql_fetch_assoc(getDataBaseData("clients", array("client_id" => intval($strClient))));
                $strContents .= "
                        <tr class = \"planning_evening\">
                            <td>".$strTime." => </td><td>".$arrClientData["client_firstname"]." ".$arrClientData["client_lastname"]."</td>
                        </tr>";
            }
            $strContents .= "
                    </table>
                </div>";
        }
        else
        {
            $strContents .= "
                <table>
                    <a href = \"/index.php/planning?day=$strDay&month=$strMonth&year=$strYear\">Nog geen planning. Vul planning voor deze dag in.</a>
                </table>";
        }
        
        $strContents .= build_footer();

        return $strContents;
    }
}
