<?php

Class Planning_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu)
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
        $strContents .= $this->calendar->generate(date("Y"), date("n"), $arrData);
        
        $strContents .= "";
        
        $strContents .= build_footer();

        return $strContents;
    }
}
