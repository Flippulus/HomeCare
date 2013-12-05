<?php


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