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
        
        while($arrUserData == mysql_fetch_assoc($result))
        {
            $strContents .= "<tr class ='usertabletitle'><td>".
            $arrUserData["firstname"]."</td><td>".
            $arrUserData["lastname"].
            "</td></tr>". 
            "<tr id ='".$arrUserData['id']."' class ='usertablehidden'>".
            "<td>".$arrUserData["street"]."</td>".
            "<td>".$arrUserData["number"]."</td>".
            "<td>".$arrUserData["mailbox"]."</td>".
            "<td>".$arrUserData["postal"]."</td>".
            "<td>".$arrUserData["location"]."</td>".
            "<td>".$arrUserData["phone"]."</td>".
            "<td>".$arrUserData["cell"]."</td>".
            "<td>".$arrUserData["mail"]."</td>";
                     
        }
        $strContents .="</table>";
        return $strContents;
    }
}
?>