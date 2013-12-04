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
    function getPageData()
    {
        $strContents = "";
        
        $result = getDataBaseData("users");
        
        $strContents .= "<table>";
        
        while($arrUserData = mysql_fetch_assoc($result))
        {
            $strContents .= "<tr class ='usertabletitle'><td>".
            $arrUserData["user_firstname"]."</td><td>".
            $arrUserData["user_lastname"].
            "</td></tr>". 
            "<tr id ='".$arrUserData['user_id']."' class ='usertablehidden'>".
            "<td>".$arrUserData["user_street"]."</td>".
            "<td>".$arrUserData["user_streetnumber"]."</td>".
            "<td>".$arrUserData["user_postal"]."</td>".
            "<td>".$arrUserData["user_location"]."</td>".
            "<td>".$arrUserData["user_phone"]."</td>".
            "<td>".$arrUserData["user_cell"]."</td>".
            "<td>".$arrUserData["user_mail"]."</td>";
                     
        }
        $strContents .="</table>";
        return $strContents;
    }
}
?>