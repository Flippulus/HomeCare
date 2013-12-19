<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Account_Model extends CI_Model
{
    
      function getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {   
        $strContents = "";
        
        $result = getDataBaseData("users", array("user_id" => $_SESSION["userid"]));
        
        $strContents .= "</head>
                        <body>";
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= "
                        <div class='homecaretable'>";
        
        $arrUserData = mysql_fetch_assoc($result);
        {
            
            $strContents .= " <table border ='1'>
                            <thead>
                                <tr style='cursor: pointer;'>
                                    <td>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</td>
                                    <td id='editClass'><a href=/index.php/account?edit_account=".$arrUserData["user_id"].">Pas aan</a></td>
                                </tr>
                            </thead>
   
            <tr style='display:none' id = \"".$arrUserData["user_id"]."\" class = \"user".$arrUserData["user_id"]."\"><td>Straat: </td><td>".$arrUserData["user_street"]."</td></tr>
            <tr><td>Nummer: </td><td>".$arrUserData["user_streetnumber"]."</td></tr>
            <tr><td>Postcode: </td><td>".$arrUserData["user_postal"]."</td></tr>
            <tr><td>Gemeente: </td><td>".$arrUserData["user_location"]."</td></tr>
            <tr><td>Telefoon: </td><td>".$arrUserData["user_phone"]."</td></tr>
            <tr><td>GSM: </td><td>".$arrUserData["user_cell"]."</td></tr>
            <tr><td>Email: </td><td>".$arrUserData["user_mail"]."</td></tr></table>";
        }
        $strContents .="</div>";
        return $strContents;
    }
    
    
    function getAdjustData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu, $intUserId)
    {
        
         $strContents = "";
        
        $result = getDataBaseData("users",array("user_id" => $_SESSION["userid"]));
        
        $strContents .= "</head>
                        <body>";
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .=buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= "
                        <div class='homecaretable'>";
        
        $arrUserData = mysql_fetch_assoc($result);
        {
            
            $strContents .= "<table border ='1'>
                            <thead>
                            <tr style='cursor: pointer;'>
                                <td>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</td>
                                <td id='editClass'><input type ='submit' name ='frmSaveAccount' value='Sla op'/></td>
                            </thead>
                            </tr>
                            
            <tr><td>Straat: </td><td><input type='text' value='".$arrUserData["user_street"]."'placeholder ='Straat'/></td></tr>
            <tr><td>Nummer: </td><td><input type='text' value='".$arrUserData["user_streetnumber"]."' placeholder='Nummer'/></td></tr>
            <tr><td>Postcode: </td><td><input type='number' value='".$arrUserData["user_postal"]."' placeholder='Postcode'/></td></tr>
            <tr><td>Gemeente: </td><td><input type='text' value='".$arrUserData["user_location"]."' placeholder='Gemeente'/></td></tr>
            <tr><td>Telefoon: </td><td><input type='number' value='".$arrUserData["user_phone"]."' placeholder='Telefoon'/></td></tr>
            <tr><td>GSM: </td><td><input type='number' value='".$arrUserData["user_cell"]."' placeholder='GSM'/></td></tr>
            <tr><td>Email: </td><td><input type='text' value='".$arrUserData["user_mail"]."' placeholder='Email'/></td></tr></table><br/>";
        }
        
        $strContents .="</div>";
        return $strContents;
    }
        
    function setAdjustData ($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        
        
        
        
    }
    
   
}
