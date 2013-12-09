<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * - id
 * - firstname..
 * - lastname..
 * - street
 * - number
 * - mailbox (bus nummer)
 * - postal 
 * - location
 * - phone
 * - cell
 * - mail
 */

class Team_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "";
        
        $result = getDataBaseData("users");
        
        $strContents .= "</head>
                        <body>";
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= "
                        <div id='wrap'>";
        
        while($arrUserData = mysql_fetch_assoc($result))
        {
            
            $strContents .= " <table border ='0'>
                            <tr class ='usertabletitle'>
                                <td>".$arrUserData["user_firstname"]."</td>
                                <td>".$arrUserData["user_lastname"]."</td>
                            </tr>
                            <tr onclick = \"showHide('".$arrUserData["user_id"]."');\">
                                <td>See more.</td>
                            </tr>  
                        </table>
                        <table id='".$arrUserData["user_id"]."' class='more'>".      
            "<tr><td>".$arrUserData["user_street"]."</td></tr>".
            "<tr><td>".$arrUserData["user_streetnumber"]."</td></tr>".
            "<tr><td>".$arrUserData["user_postal"]."</td></tr>".
            "<tr><td>".$arrUserData["user_location"]."</td></tr>".
            "<tr><td>".$arrUserData["user_phone"]."</td></tr>".
            "<tr><td>".$arrUserData["user_cell"]."</td></tr>".
            "<tr><td>".$arrUserData["user_mail"]."</td></tr>";
            
                     
        }
        $strContents .="</table></div>";
        return $strContents;
    }
}
?>