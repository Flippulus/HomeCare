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
    
    changeDataBaseRecord('users', array("user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                        "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile,
                                        "user_mail" => $strMailadress), "user_id", $_SESSION["userid"]);
    
}