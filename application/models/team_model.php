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
        
        $strContents .= "</head>
                        <body>
                        <h1>Team Members</h1>
                        <div id='wrap'>
                        <table border ='1'>";
        
        while($arrUserData = mysql_fetch_assoc($result))
        {
            $strContents .= "<tr class ='usertabletitle'><td>".
            $arrUserData["user_firstname"]."</td><td>".
            $arrUserData["user_lastname"].
            "</td></tr>".
            "<tr><td><a href='#' id='example-show' class='showLink' onclick='showHide('example');return false;'>See more.</a></tr></td>".
                    
            "<div id='example' class='more'>".      
            "<tr id ='".$arrUserData['user_id']."' class ='usertablehidden'>".
            "<tr><td>".$arrUserData["user_street"]."</td></tr>".
            "<tr><td>".$arrUserData["user_streetnumber"]."</td></tr>".
            "<tr><td>".$arrUserData["user_postal"]."</td></tr>".
            "<tr><td>".$arrUserData["user_location"]."</td></tr>".
            "<tr><td>".$arrUserData["user_phone"]."</td></tr>".
            "<tr><td>".$arrUserData["user_cell"]."</td></tr>".
            "<tr><td>".$arrUserData["user_mail"]."</td></tr></tr>".
            "<tr><td><a href='#' id='example-hide' class='hideLink' onclick='showHide('example');return false;'>Hide this content.</a></tr></td>".
            "</div>";
            
                     
        }
        $strContents .="</table></div>";
        return $strContents;
    }
}
?>