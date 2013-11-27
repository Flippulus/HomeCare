<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Documenten_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body style =\"text-align:center\">";
        ;

        $strContents.=build_main_menu($arrMainMenuItems, $strActiveMenu);

        $strContents.= "
                    <form method=\"POST\" enctype=\"multipart/form-data\" >
                        Select File To Upload:<br />
                        <input type=\"file\" name=\"userfile\" />
                        <br /><br />
                        <input type=\"submit\" name=\"frmFileUpload\" value=\"Upload\" class=\"btn btn-success\" />
                    </form>";


        $strContents .= build_footer();
        return $strContents;
    }

}

?>
