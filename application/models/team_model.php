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
                        <div class='CSSTableGenerator'>";
        
        while($arrUserData = mysql_fetch_assoc($result))
        {
            
            $strContents .= " <table border ='1'>
                            <tr style='cursor: pointer;' onclick = \"showHide('".$arrUserData["user_id"]."');\">
                                <td colspan='2'>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</td>
                            </tr>
   
            <tr><td>Straat: </td><td>".$arrUserData["user_street"]."</td></tr>
            <tr><td>Nummer: </td><td>".$arrUserData["user_streetnumber"]."</td></tr>
            <tr><td>Postcode: </td><td>".$arrUserData["user_postal"]."</td></tr>
            <tr><td>Gemeente: </td><td>".$arrUserData["user_location"]."</td></tr>
            <tr><td>Telefoon: </td><td>".$arrUserData["user_phone"]."</td></tr>
            <tr><td>GSM: </td><td>".$arrUserData["user_cell"]."</td></tr>
            <tr><td>Email: </td><td>".$arrUserData["user_mail"]."</td></tr></table><br/>";
         
        }
        $strContents .="</div>";
        return $strContents;
    }
}
?>
