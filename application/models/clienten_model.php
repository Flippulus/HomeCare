<?php

class Clienten_Model extends CI_Model
{
    //Deze functie toont de gegevens van de clienten
    function getClientData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu, $strId)
    {
         $strSql="SELECT * FROM clients AS c1
             LEFT JOIN users AS u1 ON c1.added_by_user=u1.user_id
             ORDER BY client_lastname ASC";
         
         $strContent = "
            </head>
            <body>";
         $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
         $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
         
         $strContent.="";
         $result = mysql_query($strSql);
         $strContent .="
        <div class='homecaretable'>";
        if($result == null)
        {
            $strContent .="
            <table>
                <tr>
                    <td>
                        Er ging iets fout. Vraag je lokale admin voor hulp
                        Bericht voor admin:' \$result=null bij getClientData-->clienten_model'.
                    </td>
                </tr>
            </table>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                if($arrTopicData["client_id"]==$strId)
                {
                $arrResponsible=  mysql_fetch_assoc(getDataBaseData('users', array('user_id'=>$arrTopicData['client_responsible_user'])));
                $strContent .="
            <table>
                <thead>
                    <tr>
                        <td>".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</td>
                        <td id='editClass'><a href=/index.php/clienten?edit_client=".$arrTopicData["client_id"].">Pas aan</a>
                    </tr>
                </thead>
                <tbody>
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
                        <td>Geboortedatum: </td>
                        <td>".
                            date("d/m/Y",strtotime($arrTopicData["client_birthdate"]))."
                        </td>
                    </tr>
                    <tr>
                        <td>Geslacht: </td>
                        <td>";
                        if($arrTopicData["client_gender"]==1)
                        {
                            $strContent .="Man";
                        }
                        else
                        {
                           $strContent .="Vrouw" ;
                        }
                        $strContent .="
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
                        <td>RijksRegister: </td>
                        <td>".
                            $arrTopicData["client_civil_register"]."
                        </td>
                    </tr>
                    <tr>
                        <td>Nummer van de Gezondheidszorg: </td>
                        <td>".
                            $arrTopicData["client_healthcare_number"]."
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
                        <td>Huisarts: </td>
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
                        <td>Toegevoegd door: </td>
                        <td>".
                            $arrTopicData["user_firstname"].
                            "
                        </td>
                    </tr>
                    <tr>
                        <td>Toegevoegd op: </td>
                        <td>".
                            date("d/m/Y h:i",strtotime($arrTopicData["client_join_datetime"]))."
                        </td>
                    </tr>
                    <tr>
                        <td>Datum van in zorg: </td>
                        <td>".
                            date("d/m/Y",strtotime($arrTopicData["client_date_in_care"]))."
                        </td>
                    </tr>
                    <tr>
                        <td>Verantwoordelijke verzorger: </td>
                        <td>".
                            $arrResponsible['user_firstname'].
                            "
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
                    </tr>
                    <tr>
                        <td>Indicatie beschrijving: </td>
                        <td>".
                            $arrTopicData["client_indication_description"]."
                        </td>
                    </tr>
                    <tr>
                        <td>Anamnese: </td>
                        <td>".
                            $arrTopicData["client_anamnese"]."
                        </td>
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
                    </tr>
                </tbody>
            </table>";
            }    
            }
        }
        
        else
        {
            $strContent .="
            <table>
                <tr>
                    <td>
                        Error: Er zijn momenteel problemen met de database. Probeer later opnieuw.
                        De database kan even offline zijn.
                    </td>
                </tr>
            </table>";
        }
        $strContent .="
        </div>";
        $strContent .= build_footer();
        
        return $strContent;
    }
    
    //Deze functie zorgt voor het toevoegen van nieuwe clienten
    function addUser($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strContent = "
            </head>
            <body>";
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
        $strContent.="";
        $strContent .="
         <div class='homecaretable'>
            <form name='addClient' method='post'>
                <table>
                    <thead>
                        <tr>
                            <td colspan='2'>Voeg een nieuwe cliënt toe</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Voornaam:</td>
                            <td><input type='text' name='firstName'></td>
                        </tr>
                        <tr>
                            <td>Achternaam:</td>
                            <td><input type='text' name='lastName'></td>
                        </tr>
                        <tr>
                            <td>Geboortedatum:</td>
                            <td>
                                <input type='date' name='dateOfBirth'>
                            </td>
                        </tr>
                        <tr>
                            <td>Geslacht</td>
                            <td>
                                <input type='radio' name='sex' value='man'>Man<br>
                                <input type='radio' name='sex' value='vrouw'>Vrouw
                            </td>
                        </tr>
                        <tr>
                            <td>Burgerlijke stand</td>
                            <td>
                                <select name='civilState'>
                                    <option value='Single'>Alleenstaand</option>
                                    <option value='Getrouwd'>Gehuwd</option>
                                    <option value='Gescheiden'>Gescheiden</option>                                
                                    <option value='Weduwe'>Weduwe-Weduwnaar</option>
                                    <option value='Samenwonend'>Samenwonend</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Naam van de partner:</td>
                            <td><input type='text' name='partnerName'></td>
                        </tr>
                        <tr>
                            <td>Rijksregister nummer:</td>
                            <td><input type='text' name='civilNumber'></td>
                        </tr>
                        <tr>
                            <td>Nummer van de gezondheidszorg: </td>
                            <td><input type='text' name='healtcareNumber'></td>
                        </tr>
                        <tr><td colspan='2'><hr/></td></tr>
                        <tr>
                            <td>Gemeente: </td>
                            <td>
                                <input type='text' name='location'>
                            </td>
                        </tr>
                        <tr>
                            <td>Postcode: </td>
                            <td>
                                <input type='number' name='postal'>
                            </td>
                        </tr>
                        <tr>
                            <td>Adres: </td>
                            <td>
                                <input type='text' name='street'>
                            </td>
                        </tr>
                        <tr>
                            <td>Huis nummer: </td>
                            <td>
                                <input type='text' name='number'>
                            </td>
                        </tr>
                        <tr>
                            <td>Box: </td>
                            <td>
                                <input type='text' name='mailbox'>
                            </td>
                        </tr>
                        <tr>
                            <td>Telefoon nummer: </td>
                            <td>
                                <input type='number' name='phone'>
                            </td>
                        </tr>
                        <tr>
                            <td>GSM nummer: </td>
                            <td>
                                <input type='number' name='cell'>
                            </td>
                        </tr>
                        <tr><td colspan='2'><hr/></td></tr>
                        <tr>
                            <td>Huisarts: </td>
                            <td>
                                <input type='text' name='doctor'>
                            </td>
                        </tr>
                        <tr>
                            <td>Apotheker van de Cliënt: </td>
                            <td>
                                <input type='text' name='apothecary'>
                            </td>
                        </tr>
                        <tr>
                            <td>Datum van in zorg: </td>
                            <td>
                                <input type='date' name='dateInCare'>
                            </td>
                        </tr>
                        <tr>
                            <td>Verantwoordelijke verzorger: </td>
                            <td>
                                <select name='respUser'>";
                                    $result=getDataBaseData("users");
                                
                                    while($arrUserData = mysql_fetch_assoc($result))
                                    {
                                       $strContent.="
                                    <option value = '".$arrUserData["user_id"]."'>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</option>";
                                    }
                                        
        
                                $strContent.="
                                </select> 
                            </td>
                        </tr>
                        <tr><td colspan='2'><hr/></td></tr>
                        <tr>
                            <td>Familie gegevens: </td>
                            <td>
                                <textarea name='familyData' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Indicatie: </td>
                            <td>
                                <textarea name='indication' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Indicatie beschrijving: </td>
                            <td>
                                <textarea name='indicationDesc' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Anamnese: </td>
                            <td>
                                <textarea name='anamnese' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Medicatie lijst: </td>
                            <td>
                                <textarea name='medication' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Extra info: </td>
                            <td>
                                <textarea name='extra' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>
                            </td>
                        </tr>
                        <tr colspan='2'>
                            <td>
                                <input type='submit' value='Submit' name='frmAddClient'>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>";
        $strContent .= build_footer();
        return $strContent;
    }
    
    //Deze functie laat de hoofdpagina zien van het clienten tabblad
    function showPages($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strSql="SELECT * FROM clients
             ORDER BY client_lastname ASC";
         
         $strContent = "
            </head>
            <body>";
         $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
         $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
         
         $strContent.="";
         $result = mysql_query($strSql);
         $strContent .="
                <div class='homecaretable'>";
         
         if($result == null)
        {
            $strContent .="
                    <table border='1'>
                        <tr>
                            <td>
                                Er ging iets fout. Vraag je lokale admin voor hulp
                                Bericht voor admin:' \$result==null bij showPages-->clienten_model'.
                            </td>
                        </tr>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                $strContent .="
                    <table>
                        <thead>
                            <tr style='cursor:pointer;' onclick=\"showHide('client','".$arrTopicData["client_id"]."');\">
                                <td colspan='2'>".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</td>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr style='display:none' id= '".$arrTopicData["client_id"]."' class = 'client".$arrTopicData["client_id"]."'>
                                <td>
                                    <a href=/index.php/clienten?client_id=".$arrTopicData["client_id"].">Gegevens van ".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</a>
                                </td>
                            </tr>
                            <tr class = 'client".$arrTopicData["client_id"]."'>
                                <td>
                                    <a href=/index.php/clienten?client_report=".$arrTopicData["client_id"].">Rapportages over ".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</a>
                                </td>
                            </tr>
                            <tr class = 'client".$arrTopicData["client_id"]."'>
                                <td>
                                    <a href=/index.php/clienten?client_doc=".$arrTopicData["client_id"].">Documenten van ".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>";
            }                   
        }
        
        else
        {
            $strContent .="
                    <table>
                        <tr>
                            <td>
                                Error: Er zijn momenteel problemen met de database. Probeer later opnieuw.
                                De database kan even offline zijn.
                            </td>
                        </tr>
                    </table>";
        }
        $strContent .="
                </div>";
        $strContent .= build_footer();
        
        return $strContent;
    }
    
    //Deze functie behandelt het aanpassen van de clienten gegevens
    function updateClient($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId)
    {
        $strSql="SELECT * FROM clients AS c1
             LEFT JOIN users AS u1 ON c1.added_by_user=u1.user_id
             ORDER BY client_lastname ASC";
         
         $strContent = "
            </head>
            <body>";
         $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
         $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
         
         $strContent.="";
         $result = mysql_query($strSql);
         $strContent .="
        <div class='homecaretable'>";
        if($result == null)
        {
            $strContent .="
            <table>
                <tr>
                    <td>
                        Er ging iets fout. Vraag je lokale admin voor hulp
                        Bericht voor admin:' \$result=null bij getClientData-->clienten_model'.
                    </td>
                </tr>
            </table>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                if($arrTopicData["client_id"]==$strId)
                {
                $arrResponsible=  mysql_fetch_assoc(getDataBaseData('users', array('user_id'=>$arrTopicData['client_responsible_user'])));
                $strContent .="
            <form name='editClient' method='post'>        
            <table>
                <thead>
                    <tr>
                        <td>".$arrTopicData["client_firstname"]." ".$arrTopicData["client_lastname"]."</td>
                        <td id='editClass'><input type='submit' value='Sla op' name='frmEditClient'>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Naam: </td>
                        <td>
                            <textarea name='firstName' id='firstName' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_firstname"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Achternaam: </td>
                        <td>
                            <textarea name='lastName' id='lastName' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_lastname"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Geboortedatum: </td>
                        <td>
                            <input type='date' name='dateOfBirth' value=".date("d/m/Y",strtotime($arrTopicData["client_birthdate"])).">
                        </td>
                    </tr>
                    <tr>
                        <td>Geslacht: </td>
                        <td>";
                        if($arrTopicData["client_gender"]==1)
                        {
                            $strContent .="
                                <input type='radio' name='sex' value='man' checked>Man<br>
                                <input type='radio' name='sex' value='vrouw'>Vrouw";
                        }
                        else
                        {
                           $strContent .="
                                <input type='radio' name='sex' value='man'>Man<br>
                                <input type='radio' name='sex' value='vrouw' checked>Vrouw" ;
                        }
                        $strContent .="
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Burgerlijke stand: </td>
                        <td>
                            <select name='civilState'>";
                                $arr = array("Alleenstaand", "Gehuwd", "Gescheiden","Weduwe/weduwnaar","Samenwonend");
                                foreach($arr as $value) {
                                    $strContent .= '<option value="'.$value.'"';
                                    if($arrTopicData["client_civil_state"] === $value) 
                                    {
                                        $strContent .= 'selected>'.$value;
                                    }
                                    else 
                                    {
                                        $strContent .=">".$value;
                                    }
                                }

                            $strContent .="</select> 
                        </td>
                    </tr>
                    <tr>
                        <td>Naam van de partner: </td>
                        <td>
                            <textarea name='partnerName' id='partnerName' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_partner_name"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>RijksRegister: </td>
                        <td>
                            <input type='number' name='civilNumber' value=".$arrTopicData["client_civil_register"].">
                        </td>
                    </tr>
                    <tr>
                        <td>Nummer van de Gezondheidszorg: </td>
                        <td>
                            <input type='number' name='healtcareNumber' value=".$arrTopicData["client_healthcare_number"].">
                        </td>
                    </tr>
                    <tr><td colspan='2'><hr/></td></tr>
                    <tr>
                        <td>Gemeente: </td>
                        <td>
                            <textarea name='location' id='location' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_location"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Postcode: </td>
                        <td>
                            <input type='number' name='postal' value=".$arrTopicData["client_postal"].">
                        </td>
                    </tr>
                    <tr>
                        <td>Adres: </td>
                        <td>
                            <textarea name='street' id='street' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_streetname"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Huis nummer: </td>
                        <td>
                            <input type='text' name='number' value=".$arrTopicData["client_streetnumber"].">
                        </td>
                    </tr>
                    <tr>
                        <td>Box: </td>
                        <td>
                            <input type='text' name='mailbox' value=".$arrTopicData["client_mailbox"].">
                        </td>
                    </tr>
                    <tr>
                        <td>Telefoon nummer: </td>
                        <td>
                            <input type='number' name='phone' value=".$arrTopicData["client_phone"].">
                        </td>
                    </tr>
                    <tr>
                        <td>GSM nummer: </td>
                        <td>
                            <input type='number' name='cell' value=".$arrTopicData["client_cell"].">
                        </td>
                    </tr>
                    <tr><td colspan='2'><hr/></td></tr>
                    <tr>
                        <td>Huisarts: </td>
                        <td>
                            <textarea name='doctor' id='doctor' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_doctor"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Apotheker van de Cliënt: </td>
                        <td>
                            <textarea name='apothecary' id='apothecary' cols='15' rows='1' wrap='soft' style='resize: none'>".$arrTopicData["client_apothecary"]."</textarea>
                        </td>
                    </tr>
                    <tr><td colspan='2'><hr/></td></tr>
                    <tr>
                        <td>Datum van in zorg: </td>
                        <td>
                            <input type='date' name='dateInCare' value=".date("d/m/Y",strtotime($arrTopicData["client_date_in_care"])).">
                        </td>
                    </tr>
                    <tr>
                        <td>Verantwoordelijke verzorger: </td>
                        <td>
                            <select name='respUser'>";
                            $result=getDataBaseData("users");

                            while($arrUserData = mysql_fetch_assoc($result))
                            {
                                if($arrUserData["user_id"]==$arrTopicData['client_responsible_user'])
                                {
                                    $strContent.="
                                    <option value = '".$arrUserData["user_id"]."' selected>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</option>";
                                }
                                else
                                {
                                    $strContent.="
                                    <option value = '".$arrUserData["user_id"]."'>".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</option>";
                                }
                            }
                                        
        
                                $strContent.="</select> 
                            </td>
                    </tr>
                    <tr><td colspan='2'><hr/></td></tr>
                    <tr>
                        <td>Familie gegevens: </td>
                        <td>
                            <textarea name='familyData' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_family_data"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Indicatie: </td>
                        <td>
                            <textarea name='indication' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_indication"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Indicatie beschrijving: </td>
                        <td>
                            <textarea name='indicationDesc' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_indication_description"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Anamnese: </td>
                        <td>
                            <textarea name='anamnese' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_anamnese"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Medicatie lijst: </td>
                        <td>
                            <textarea name='medication' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_medication_list"]."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Extra info: </td>
                        <td>
                            <textarea name='extra' id='description' cols='80' rows='8' maxlength='2048' wrap='soft' style='resize: none'>".$arrTopicData["client_extra_note"]."</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>";
            }    
            }
        }
        
        else
        {
            $strContent .="
            <table>
                <tr>
                    <td>
                        Error: Er zijn momenteel problemen met de database. Probeer later opnieuw.
                        De database kan even offline zijn.
                    </td>
                </tr>
            </table>";
        }
        $strContent .="
        </div>";
        $strContent .= build_footer();
        
        return $strContent;
    }
    
    //Deze functie laat de rapportages zien die bij de clienten horen
    function getReportData($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu,$strId)
    {
        $boolCheck=false;
        $strSql="SELECT * FROM reports 
            LEFT JOIN users ON reports.reported_by_user=users.user_id 
            WHERE report_client = '$strId'
            ORDER BY report_id DESC";
         
         $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
        $strContent.="";
        $result = mysql_query($strSql);
        $strContent .="    
        <div class='homecaretable'>
            <table id='reportTable'>
                <thead>
                    <tr>";
                        $arrClientName= mysql_fetch_assoc(getDataBaseData('clients', array("client_id" => $strId)));
                        
                        $strContent .="
                        <td colspan='4'>Rapportages over ". $arrClientName["client_firstname"]." ".$arrClientName["client_lastname"] ."</td>";
            
                    $strContent .="
                    </tr>
                </thead>
                <tbody>";
        
        if($result == null)
        {
            $strContent .="
                    <tr>
                        <td>
                            Er zijn  nog geen rapportages in de database.
                        </td>
                    </tr>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                $boolCheck=true;
                if($arrTopicData["report_client"]==$strId)
                {
                    $strContent .="
                        <tr>
                            <td >".
                                $arrTopicData["report_content"]."
                            </td>
                            <td>".
                                "Gepost
                                <br>
                                ".strftime("%A %e %B %Y", strtotime($arrTopicData["report_datetime"]))."
                                <br>
                                Om ".date("H:i", strtotime($arrTopicData["report_datetime"]))."
                            </td>
                            <td>
                                Door 
                                <br>
                                ". $arrTopicData["user_firstname"]."
                            </td>";

                    if ($_SESSION['userid']==$arrTopicData["user_id"])
                    {
                        $strContent.="
                            <td>
                                <a href='/index.php/clienten?client_report=".$strId."&report_id=".$arrTopicData["report_id"]."'>Pas aan</a>
                            </td>
                        </tr>";
                    }
                    else{$strContent.="
                            <td>
                            </td>
                        </tr>";}
                } 
                
            }
            if($boolCheck==true)
            {
                //Leeg laten, Dit is slechts een controle om te kijken of de while lus uitgevoerd word
            }
            else
            {
                $strContent .="

                    <td>
                        Er zijn  nog geen rapportages in de database over deze client.
                    </td>
                ";
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
                </tbody>
            </table>
        </div>
        <br/>
        <br/>
                    <div class='homecaretable'>
                        <table>
                            <thead>
                                <tr>
                                    <td>Voeg een nieuwe rapportage toe bij deze cliënt</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form name='client_report_input'  method='post'>
                                            <textarea name='report_content' id='description' cols='94' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>          
                                            <div id='characterLeft'></div>
                                            <br/>
                                            <input type='submit' value='Submit' name='frmSubmitClientReport'>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>";
        
        $strContent .= build_footer();
        
        return $strContent;
    }

    //Deze functie laat de documenten zien die bij de clienten horen
    function getDocData($arrMainMenuItems, $strActiveMenu, $arrSubMenuItems,$strActiveSubMenu, $strId)
    {
        $result2 = getDataBaseData("documents", array("doc_about_client" => $strId));
        
        $boolCheck=false;
        
        $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
        $strContent.= "
                <div id = \"info\">
                    <h4>Geselecteerd document</h4>
                    <div id = \"file_info\">
                        
                    </div>
                </div>
                <div id = \"documents_container\">
                    <div id = \"doc_list\">
                        <ul class = \"maps\">";
        
        $strJs = "
            <script>
                var client = ".$_GET["client_doc"]."
                var arrDocs = [";
        
        if ($result2 !=false)
        {
            while($arrDocData = mysql_fetch_assoc($result2))
            {
                $intId = $arrDocData["doc_id"];
                $arrDocType = preg_split('/[.]/', $arrDocData["doc_name"]);
                $strDocName = $arrDocType[0];
                $strDocType = $arrDocType[1];
                $boolCheck=true;
                $strContent .= "
                            <li class = \"doc\" id = \"doc_".$arrDocData["doc_id"]."\" onclick = \"selectclientdoc(this);\">".$arrDocData["doc_name"]."</li>";
                $strJs .= "[$intId, '$strDocName', '$strDocType', '".$strId."'], ";
            }
            $strContent .= "
                        </ul>
                    </div>
                    ";
        }
        
        $strJs .= "
            ];
            </script>";
        
        if($boolCheck==true)
        {
             //Leeg laten, Dit is slechts een controle om te kijken of de while lus uitgevoerd word
        }
        else
        {
            $strContent .="
                            <li class = \"doc\">
                                Er zijn  nog geen documenten in de database over deze client.
                            </li>
                        </ul>
                    </div>
            ";
        }
        $strContent.= "
                    <div id = \"upload\">
                        <form method = \"POST\" enctype = \"multipart/form-data\" >
                            Kies een bestand om te uploaden:
                            <br>
                            <br>
                            <input type = \"file\" name = \"userfile\" />
                            <br>
                            <input type = \"submit\" name = \"frmFileUpload\" value = \"Uploaden\" />
                            <input type = \"hidden\" id = \"selecteddoc\" name = \"selecteddoc\" value = \"\">
                        </form>
                    </div>
                </div>";
        
        
        $strContent .= build_footer();
        $strContent .= $strJs;
        
        return $strContent;
    }

}