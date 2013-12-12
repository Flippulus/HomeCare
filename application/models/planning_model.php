<?php

Class Planning_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strContents = "
            </head>
            <body>";
        
        if(isset($_GET["day"]))
        {$intDay = $_GET["day"];}
        else
        {$intDay = date("d");}
        
        $arrPrefs = getCalendarPrefs();

        $this->load->library("calendar", $arrPrefs);
        $arrData = array();
        for ($i = 1; $i < 32; $i++)
        {$arrData[$i] = "?view=day&day=$i";}
        
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= $this->calendar->generate(date("Y"), date("n"), $arrData);
        
        $arrDayData = mysql_fetch_assoc(getDataBaseData("planning", array("planning_date" => date("Y-m-d"))));
        
        $strContents .= "
            <div class = \"homecaretable\">
                <table>
                    <tr style = \"cursor:pointer;\" onclick = \"showHide('planning_', 'morning')\">
                        <td>Ochtend: ";
        
        $strContents .= build_footer();

        return $strContents;
    }
}
