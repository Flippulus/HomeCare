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
                                         <input required name = \"user_street\" type= 'text' placeholder = 'Straat' />
                                    </td>
                                    <td>
                                         <input required name = \"user_streetnumber\" type= 'text' placeholder = 'Straat nummer' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <input required name = \"user_postal\" type= 'text' placeholder = 'Postcode' />
                                    </td>
                                    <td>
                                         <input required name = \"user_location\" type= 'text' placeholder = 'Gemeente' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <input required name = \"user_phone\" type= 'text' placeholder = 'Telefoon' />
                                    </td>
                                    <td>
                                         <input required name = \"user_cell\" type= 'text' placeholder = 'GSM' />
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>";
        $strContents .= build_footer();
        return $strContents;
    }
    
  
}
