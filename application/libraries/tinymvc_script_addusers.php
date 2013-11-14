<?php

/*
 * 
 * PHP version 5
 * 
 * @Package accountanting
 * @Author Philippe Dirx <philippedirx@hotmail.com>
 * @Copyright 2013
 * @License
 * 
 * 
 * This file is property of Philippe Dirx.
 * This file is not meant to be used by others then Philippe Dirx or his assigners.
 * This file is created for the sole purpose of supporting the company of ThreeS, property of Rudi op 't Roodt, Boy Smeets and Roné Kirkels
 * 
 * 
 * Using tinyMVC structure: Model <- Controller -> View
 * 
 */

function addAdminToDB()
{
    //creating random variable to use in account activation.
    $intActivationNumber = rand(100000, 1000000);
    //Putting user data in arrays to enter into Databases
    $arrParameters = array(
        "firstname" => $_POST["user_firstname"],
        "lastname" => $_POST["user_lastname"],
        "mail" => $_POST["user_mail"],
        "password" => "",
        "active" => $intActivationNumber,
        "level" => $_POST["user_level"]
    );
    
    $result = insertDataBaseData("users", $arrParameters);
    if($result == false)
    {}
    else
    {
        //Checking if mailbox is entered, if not "/" will be inserted into DB, to show there is none set.
        if($_POST["user_streetmailbox"] == "")
        {$strMailBox = "/";}
        else
        {$strMailBox = $_POST["user_streetmailbox"];}
        
        //Getting user_id from users database so these will be the same in both DB's
        $result = getDataBaseData("users", $arrParameters);
        $arrUserData = mysql_fetch_assoc($result);
        //Creating parameters for entry into admin_users database
        $arrParameters = array(
            "id" => $arrUserData["id"],
            "gender" => $_POST["user_title"],
            "lastname" => $_POST["user_lastname"],
            "firstname" => $_POST["user_firstname"],
            "street" => $_POST["user_streetname"],
            "number" => $_POST["user_streetnumber"],
            "mailbox" => $strMailBox,
            "postalcode" => $_POST["user_postal"],
            "location" => $_POST["user_location"],
            "province" => $_POST["user_province"],
            "country" => $_POST["user_country"],
            "phone" => $_POST["user_phone"],
            "cell" => $_POST["user_cell"],
            "email" => $_POST["user_mail"],
            "level" => $_POST["user_level"],
        );
        
        $result = insertDataBaseData("adminusers", $arrParameters);
        if($result == false)
        {
            deleteFromDataBase("users", "id", $arrUserData["id"]);
        }
        else
        {
            $strContent = "
                <h1>Welkom bij ThreeS!</h1>
                <img src =\"http://www.threes.eu/nl/images/ThreeS.png\" />
                <br>
                <a href = \"http://www.threes.eu/nl/index.php/activateuser/index?code=".$intActivationNumber."&id=".$arrUserData["id"]."\">Volg aub deze link om uw account te activeren.</a>
                <hr>
                <p>Copyright ThreeS</p>";
            mailto("ThreeS Admin", $_POST["user_mail"], $strContent);
        }
    }
}

?>