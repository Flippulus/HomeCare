<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Registreer_team_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strContents = "";

        $strContents .= "</head>
                        <body>";
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .=buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= "
                        <div class='homecaretable'>";

        $strContents .="<table border='1'>
     <form method='post'>      
       
            <thead>
                <tr style='cursor: pointer;'>
                    <td> Registreer teamlid</td>
                </tr>
            </thead>
            
            <tr style='font-size:12px;'>
                <td>Vul het emailadres in van de persoon die je wil toevoegen</td>
            </tr>

            <tr>
                <td><input style='width:220px;' type='email' name='user_email' placeholder='e-mail'/></td>
            </tr>

 
            <tr>
            <td><input type='submit' value='Send' name = \"frmAddUser\" /></td>
            </tr>
       
    </form>
    </table>";

        $strContents .="</div>";
        $strContents.=build_footer();
        return $strContents;
    }
    
    function getRegisterData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strContents = "";
        
        saveAccount("register_team");
        
        $strContents .= "</head>
                        <body>";
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContents .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        $strContents .= "
                        <div class='homecaretable'>";

        $strContents .="<table border='1'>
     <form method='post'>      
       
            <thead>
                <tr style='cursor: pointer;'>
                    <td> Registreer teamlid</td>
                </tr>
            </thead>
            
            <tr style='font-size:12px;'>
                <td>Registratie email verzonden!</td>
            </tr>

            <tr>
                <td><input style='width:220px;' type='email' name='user_email' placeholder='e-mail'/></td>
            </tr>

 
            <tr>
            <td><input type='submit' value='Send' name = \"frmAddUser\" /></td>
            </tr>
       
    </form>
    </table>";

        $strContents .="</div>";
        $strContents.=build_footer();
        return $strContents;
    }
    
}
