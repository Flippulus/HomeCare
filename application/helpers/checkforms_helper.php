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
    $strFirstpassword = $_POST['user_first_password'];
    $strSecondpassword = $_POST['user_second_password'];
    
    if($_POST["user_first_password"] != "" && $_POST["user_second_password"] != "")
    {
       if(checkPassword($strFirstpassword, $strSecondpassword) == true)
    {
           $arrUserData = mysql_fetch_assoc($result = getDataBaseData("users", array("user_id" => $_SESSION["userid"])));
            $strEncryptedPassword = encryptPassword($arrUserData["user_mail"], $strFirstpassword);
            
              changeDataBaseRecord('users', array("user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                        "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile,  "user_password" => $strEncryptedPassword
                             ), "user_id", $_SESSION["userid"]);
    }
              else
              {
        print '<script type="text/javascript">'; 
        print 'alert("Wachtwoorden komen niet overeen")'; 
        print '</script>';  
                  
              }
    
    }
 else 
     {
       
        
          changeDataBaseRecord('users', array("user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                        "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile
                                        ), "user_id", $_SESSION["userid"]);
     }
    
    
    
    
    
    
}

function addAccount()
{
    $strFirstname = $_POST['user_firstname'];
    $strLastname = $_POST['user_lastname'];
    $strFirstpassword = $_POST['user_first_password'];
    $strSecondpassword = $_POST['user_second_password'];
    $strStreet = $_POST['user_street'];
    $strStreetnumber = $_POST['user_streetnumber'];
    $strPostal = $_POST['user_postal'];
    $strCity = $_POST['user_location'];
    $strTelephone = $_POST['user_phone'];
    $strMobile = $_POST['user_cell']; 
    
    if(checkPassword($strFirstpassword, $strSecondpassword) == true)
    {
        $arrUserData = mysql_fetch_assoc($result = getDataBaseData("users", array("user_activated" => $_GET["id"])));
        $strEncryptedPassword = encryptPassword($arrUserData["user_mail"], $strFirstpassword);
        changeDataBaseRecord('users', array("user_firstname" => $strFirstname, "user_lastname" => $strLastname, "user_password" => $strEncryptedPassword, "user_rights" => "0",
                                            "user_street" => $strStreet, "user_streetnumber" => $strStreetnumber, "user_postal" => $strPostal,
                                            "user_location" => $strCity, "user_phone" => $strTelephone, "user_cell" => $strMobile, "user_activated" => "true", "user_level" => 1),
                                            "user_activated", $_GET["id"]);
    }
}