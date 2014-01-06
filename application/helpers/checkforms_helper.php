<?php


function checkPassword($strPassword, $strPasswordAgain)
{
    if ($strPassword == $strPasswordAgain)
    {
        return true;
    }
}

function changeAccountData()
{
    
    $strStreet = $_POST['street'];
    $strStreetnumber = $_POST['number'];
    $strPostal = $_POST['postal'];
    $strCity = $_POST['city'];
    $strTelephone = $_POST['telephone'];
    $strMobile = $_POST['mobile'];
    $strMailadress = $_POST['mailadress'];
    
    changeDataBaseRecord('users', array("user_street" => $strStreet));
    changeDataBaseRecord('users', array("user_streetnumber" => $strStreetnumber));
    changeDataBaseRecord('users', array("user_postal" => $strPostal));
    changeDataBaseRecord('users', array("user_location" => $strCity));
    changeDataBaseRecord('users', array("user_phone" => $strTelephone));
    changeDataBaseRecord('users', array("user_cell" => $strMobile));
    changeDataBaseRecord('users', array("user_mail" => $strMailadress));

    
}