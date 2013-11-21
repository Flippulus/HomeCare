<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Class Documenten_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $blnLoggedOn)
    {
        $strContents = "
            </head>
            <body style =\"text-align:center\">";;

            $strContents.=build_main_menu($arrMainMenuItems, $blnLoggedOn);
            
            if (!isset($_POST["frmDocument"])){
                
                $strContents.= "
<h2>Document uploaden</h2>
<form method=\"post\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"frmDocument\" value=\"true\">
<table border=\"1\">

<tr>
    <td>Naam document</td>
    <td><input type=\"text\" name=\"naam\" size=\"20\"></td>
</tr>
<tr>
    <td>Document</td>
    <td><input type=\"file\" name=\"doc\"></td>
</tr>
<tr>
    <td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Upload\"></td>
</tr>
</table>
</form>  ";
                
            }
            
            else
            {
                echo "gelukt";
    
            }
            
        
        $strContents .= build_footer();
        return $strContents;
    }
    
    
    
    
    
    
}
?>
