<?php

class Clienten_Model extends CI_Model
{
     function getClientData($arrMainMenuItems, $strActiveMenu)
     {
         $strSql="SELECT * FROM clients LEFT JOIN users ON clients.added_by_user=users.user_id ORDER BY client_lastname ASC";
         
         $strContent = "
            </head>
                <body onload='start();'>";
         $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
         
         $strContent.="";
         $result = mysql_query($strSql);
         $strContent .="
            <table class='topic'  style = 'border: 1px #000000 solid;'>";
        
        if($result == null)
        {
            $strContent .="
                <tr>
                    <td>
                        Er zijn  nog geen cliënten in de database.
                    </td>
                </tr>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                $strContent .="
                <tr>
                    <td>Toegevoegd door: </td>
                    <td>".
                        $arrTopicData["user_firstname"]."
                    </td>
                </tr>
                <tr>
                    <td>Toegevoegd op: </td>
                    <td>".
                        $arrTopicData["client_join_datetime"]."
                    </td>
                </tr>
                <tr>
                    <td>Datum van in zorg: </td>
                    <td>".
                        $arrTopicData["client_date_in_care"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Verantwoordelijke verzorger: </td>
                    <td>".
                        $arrTopicData["user_firstname"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr><td colspan='2'><hr/></td></tr>
                <tr>
                    <td>Naam: </td>
                    <td>".
                        $arrTopicData["client_firstname"]."
                    </td>
                </tr>
                <tr>
                    <td>Achternaam: </td>
                    <td>".
                        $arrTopicData["client_lastname"]."
                    </td>
                </tr>
                <tr>
                    <td>Geslacht: </td>
                    <td>".
                        $arrTopicData["client_gender"]."
                    </td>
                </tr>
                <tr>
                    <td>Burgerlijke stand: </td>
                    <td>".
                        $arrTopicData["client_civil_state"]."
                    </td>
                </tr>
                <tr>
                    <td>Naam van de partner: </td>
                    <td>".
                        $arrTopicData["client_partner_name"]."
                    </td>
                </tr>
                <tr>
                    <td>Civil register: </td>
                    <td>".
                        $arrTopicData["client_civil_register"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Healtcare nummer: </td>
                    <td>".
                        $arrTopicData["client_healthcare_number"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Geboortedatum: </td>
                    <td>".
                        $arrTopicData["client_birthdate"]."
                    </td>
                </tr>
                <tr><td colspan='2'><hr/></td></tr>
                <tr>
                    <td>Gemeente: </td>
                    <td>".
                        $arrTopicData["client_location"]."
                    </td>
                </tr>
                <tr>
                    <td>Postcode: </td>
                    <td>".
                        $arrTopicData["client_postal"]."
                    </td>
                </tr>
                <tr>
                    <td>Adres: </td>
                    <td>".
                        $arrTopicData["client_streetname"]."
                    </td>
                </tr>
                <tr>
                    <td>Huis nummer: </td>
                    <td>".
                        $arrTopicData["client_streetnumber"]."
                    </td>
                </tr>
                <tr>
                    <td>Box: </td>
                    <td>".
                        $arrTopicData["client_mailbox"]."
                    </td>
                </tr>
                <tr>
                    <td>Telefoon nummer: </td>
                    <td>".
                        $arrTopicData["client_phone"]."
                    </td>
                </tr>
                <tr>
                    <td>GSM nummer: </td>
                    <td>".
                        $arrTopicData["client_cell"]."
                    </td>
                </tr>
                <tr><td colspan='2'><hr/></td></tr>
                <tr>
                    <td>Dokter van de cliënt: </td>
                    <td>".
                        $arrTopicData["client_doctor"]."
                    </td>
                </tr>
                <tr>
                    <td>Apotheker van de Cliënt: </td>
                    <td>".
                        $arrTopicData["client_apothecary"]."
                    </td>
                </tr>
                <tr><td colspan='2'><hr/></td></tr>
                <tr>
                    <td>Familie gegevens: </td>
                    <td>".
                        $arrTopicData["client_family_data"]."
                    </td>
                </tr>
                <tr>
                    <td>Indicatie: </td>
                    <td>".
                        $arrTopicData["client_indication"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Indicatie beschrijving: </td>
                    <td>".
                        $arrTopicData["client_indication_description"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Anamnese: </td>
                    <td>".
                        $arrTopicData["client_anamnese"]."
                    </td>
                    <td>????????????</td>
                </tr>
                <tr>
                    <td>Medicatie lijst: </td>
                    <td>".
                        $arrTopicData["client_medication_list"]."
                    </td>
                </tr>
                <tr>
                    <td>Extra info: </td>
                    <td>".
                        $arrTopicData["client_extra_note"]."
                    </td>
                </tr>";
            }                   
        }
        
        else
        {
            $strContent .="
                <tr>
                    <td>
                        Error: Er zijn momenteel problemen met de database. Probeer later opnieuw.
                        De database kan even offline zijn.
                    </td>
                </tr>";
        }
        $strContent .="
            </table>";
        
        //$strContent .= $this->addUser();
        $strContent .= build_footer();
        
        return $strContent;
    }
}

function addUser()
{
    
}
?>
