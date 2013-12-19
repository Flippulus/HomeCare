<?php

function add_client($firstName,$lastName,$dateOfBirth,$sex,$civilState,$partnerName,$civilNumber,$healtcareNumber,$location,$postal,$street,$number,$mailbox,$phone,$cell,$doctor,$apothecary,$dateInCare,$respUser,$familyData,$indication,$indicationDesc,$anamnese,$medication,$extra)
{
    /*if($sex=="Man")
    {$sex=1;}
    else{$sex=0;}*/
    
    
            $time=date("Y-m-d H:i:s");
            $DOB=date("Y-d-m" , strtotime($dateOfBirth));
            $sql="INSERT INTO clients(added_by_user,client_join_datetime,client_firstname,client_lastname,client_civil_register,client_healthcare_number,client_birthdate,client_streetname,client_streetnumber,client_mailbox,client_location,client_postal,client_phone,client_cell,client_gender,client_civil_state,client_partner_name,client_doctor,client_apothecary,client_responsible_user,client_date_in_care,client_family_data,client_indication,client_indication_description,client_anamnese,client_extra_note,client_medication_list)
                    VALUES('".$_SESSION['userid']."','".$time."','".strip_tags($firstName)."','".strip_tags($lastName)."','".strip_tags($civilNumber)."','".strip_tags($healtcareNumber)."','".$DOB."','".strip_tags($street)."','".strip_tags($number)."','".strip_tags($mailbox)."','".strip_tags($location)."','".strip_tags($postal)."','".strip_tags($phone)."','".strip_tags($cell)."','".strip_tags($sex)."','".strip_tags($civilState)."','".strip_tags($partnerName)."','".strip_tags($doctor)."','".strip_tags($apothecary)."','".strip_tags($respUser)."','".strip_tags(date("Y-d-m" , strtotime($dateInCare)))."','".strip_tags($familyData)."','".strip_tags($indication)."','".strip_tags($indicationDesc)."','".strip_tags($anamnese)."','".strip_tags($extra)."','".strip_tags($medication)."')";
            mysql_query($sql);
    
}

/*function Update_client()
{
    if ($content == null) 
    {
        echo"Er werden geen gegevens geupdate";
        echo"<br/>";
        echo"reden: de input was leeg";
    } 
    else 
    {
        $time = date("Y-m-d H:i:s");
        $sql = "";
        mysql_query($sql);
    }
}*/
?>
