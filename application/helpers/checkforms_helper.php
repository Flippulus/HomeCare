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
    
    changeDataBaseRecord('users', array("user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                        "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile
                                        ), "user_id", $_SESSION["userid"]);
    
}

function addAccount()
{
    $strFirstname = $_POST['user_firstname'];
    $strLastname = $_POST['user_lastname'];
    $strStreet = $_POST['user_street'];
    $strStreetnumber = $_POST['user_streetnumber'];
    $strPostal = $_POST['user_postal'];
    $strCity = $_POST['user_location'];
    $strTelephone = $_POST['user_phone'];
    $strMobile = $_POST['user_cell']; 
    
    
     changeDataBaseRecord('users', array("user_firstname" => $strFirstname,"user_lastname" => $strLastname, "user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                        "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile
                                        ), "user_activated", $_GET["id"]);
    
    
}