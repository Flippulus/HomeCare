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
 * 
 */

class NoEntry_Model extends CI_Model
{
    function getPageData()
    {
        $strContents = "
            </head>
            <body>";
        
        
        $strContents .= "<a href = \"/index.php\">
                            <img src = \"/images/forbidden.png\" alt = \"Geen toegang!\" title = \"Gebruik Backspace om terug te gaan.\" />
                         </a>";
        $strContents .= build_footer();
        
        return $strContents;
    }
}
?>