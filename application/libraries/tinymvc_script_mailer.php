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
 * script, autoloaded in sysfiles/configs/autoload.php
 * functions are public, can be hailed from any controller, model or view in myapp
 * 
 */

function mailto($strSubject, $strEmail, $strContent)
{
    $strWebMaster = "admin@ThreeS.eu";
    $strHeader = "From: ".$strWebMaster."\r\n";
    $strHeader .= "Content-type: text/html\r\n";
    //$strHeader .= "Content-type: text/html\r\n";
    $result = mail($strEmail, $strSubject, $strContent, $strHeader);
    
    if($result == false)
    {addMessageToMessageDiv("Something went wrong sending the registering email. Please try again later");}
    if($result == true)
    {addMessageToMessageDiv("Registratie email verzonden!");}
}

function mailInResponseOfOffer($strClientId, $strMail)
{
    
}

?>