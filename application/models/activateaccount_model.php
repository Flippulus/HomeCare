<?php

Class ActivateAccount_Model extends CI_Model
{
    
    function getPageData()
    {   
        
        $strContents = "</head>
                        <body>";
        
        $strContents .= "
                        <div class='homecaretable'>
                        <form method = \"post\">
                            <table border = 1>
                                <thead>
                                    <tr>
                                        <td>Registratie</td>
                                        <td><input type = 'submit' name = 'frmSaveAccount' value= 'Sla op' /></td>
                                    </tr>
                                </thead>
                            ";
        
        $strContents .= "
                                <tr>
                                    <td>
                                        <input required name = \"user_firstname\" type= 'text' placeholder = 'Voornaam' />
                                    </td>
                                    <td>
                                        <input required name = \"user_lastname\" type= 'text' placeholder = 'Familienaam' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>";
        $strContents .= build_footer();
        return $strContents;
    }
    
    
    function getAdjustData()
    {
        $strContents = "</head>
                        <body>";
        $strContents .= "
                        <div class='homecaretable'>";
        
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
        $strContents .="</div>";
        return $strContents;
    }
    
}
