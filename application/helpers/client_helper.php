<?php

function add_client($firstName,$lastName,$dateOfBirth,$sex,$civilState,$partnerName,$civilNumber,$healtcareNumber,$location,$postal,$street,$number,$mailbox,$phone,$cell,$doctor,$apothecary,$dateInCare,$respUser,$familyData,$indication,$indicationDesc,$anamnese,$medication,$extra)
{
    if($sex=="man")
    {$sex=1;}
    else{$sex=0;}
    
    
            $time=date("Y-m-d H:i:s");
            $dateOfBirth = str_replace('/', '-', $dateOfBirth);
            $DOB =date("Y-m-d" , strtotime($dateOfBirth));
            $dateInCare = str_replace('/', '-', $dateInCare);
            $DInC=date("Y-m-d" , strtotime($dateInCare));
            $sql="INSERT INTO clients(added_by_user,client_join_datetime,client_firstname,client_lastname,client_civil_register,client_healthcare_number,client_birthdate,client_streetname,client_streetnumber,client_mailbox,client_location,client_postal,client_phone,client_cell,client_gender,client_civil_state,client_partner_name,client_doctor,client_apothecary,client_responsible_user,client_date_in_care,client_family_data,client_indication,client_indication_description,client_anamnese,client_extra_note,client_medication_list)
                    VALUES('".$_SESSION['userid']."','".$time."','".strip_tags($firstName)."','".strip_tags($lastName)."','".strip_tags($civilNumber)."','".strip_tags($healtcareNumber)."','".$DOB."','".strip_tags($street)."','".strip_tags($number)."','".strip_tags($mailbox)."','".strip_tags($location)."','".strip_tags($postal)."','".strip_tags($phone)."','".strip_tags($cell)."','".strip_tags($sex)."','".strip_tags($civilState)."','".strip_tags($partnerName)."','".strip_tags($doctor)."','".strip_tags($apothecary)."','".strip_tags($respUser)."','".$DInC."','".strip_tags($familyData)."','".strip_tags($indication)."','".strip_tags($indicationDesc)."','".strip_tags($anamnese)."','".strip_tags($extra)."','".strip_tags($medication)."')";
            mysql_query($sql);
    
}

function Update_client($firstName,$lastName,$dateOfBirth,$sex,$civilState,$partnerName,$civilNumber,$healtcareNumber,$location,$postal,$street,$number,$mailbox,$phone,$cell,$doctor,$apothecary,$dateInCare,$respUser,$familyData,$indication,$indicationDesc,$anamnese,$medication,$extra,$client_id)
{
        if($sex=="man")
        {$sex='1';}
        else{$sex='0';}
        
        $dateOfBirth = str_replace('/', '-', $dateOfBirth);
        $DOB =date("Y-m-d" , strtotime($dateOfBirth));
        $dateInCare = str_replace('/', '-', $dateInCare);
        $DInC=date("Y-m-d" , strtotime($dateInCare));
        
        $sql = "UPDATE clients
            SET client_firstname= '".strip_tags($firstName)."',
                client_lastname='".strip_tags($lastName)."',
                client_civil_register='".strip_tags($civilNumber)."',
                client_healthcare_number='".strip_tags($healtcareNumber)."',
                client_birthdate='".$DOB."',
                client_streetname='".strip_tags($street)."',
                client_streetnumber='".strip_tags($number)."',
                client_mailbox='".strip_tags($mailbox)."',
                client_location='".strip_tags($location)."',
                client_postal='".strip_tags($postal)."',
                client_phone='".strip_tags($phone)."',
                client_cell='".strip_tags($cell)."',
                client_gender='".strip_tags($sex)."',
                client_civil_state='".strip_tags($civilState)."',
                client_partner_name='".strip_tags($partnerName)."',
                client_doctor='".strip_tags($doctor)."',
                client_apothecary='".strip_tags($apothecary)."',
                client_responsible_user='".strip_tags($respUser)."',
                client_date_in_care='".$DInC."',
                client_family_data='".strip_tags($familyData)."',
                client_indication='".strip_tags($indication)."',
                client_indication_description='".strip_tags($indicationDesc)."',
                client_anamnese='".strip_tags($anamnese)."',
                client_extra_note='".strip_tags($extra)."',
                client_medication_list='".strip_tags($medication)."'
            WHERE client_id='$client_id'";
        mysql_query($sql);
}
?>
