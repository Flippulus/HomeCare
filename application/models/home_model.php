<?php


class Home_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body>";
        
        
        
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
        
        $strContents .= "
        <h1>This site is still under construction!</h1>
        <div id  = \"test123\">";
        
		
        $strContents .= build_footer();
        
        return $strContents;
    }
    
}