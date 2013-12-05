<?php

Class Planning_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body>";



        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= drawCalendar();
        $strContents .= build_footer();

        return $strContents;
    }

}
