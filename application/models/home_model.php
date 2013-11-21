<?php


class Home_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $blnLoggedOn)
    {
        $strContents = "
            </head>
            <body>";
        
        
        
        $strContents .= build_main_menu($arrMainMenuItems, $blnLoggedOn);
        
        
        $strContents .= "
        <h1>This site is still under construction!</h1>";
        
		
        $strContents .= build_footer();
        
        return $strContents;
    }
    
}