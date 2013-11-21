<?php


function mailto($strSubject, $strEmail, $strContent)
{
    $strWebMaster = "admin@ThreeS.eu";
    $strHeader = "From: " . $strWebMaster . "\r\n";
    $strHeader .= "Content-type: text/html\r\n";
    //$strHeader .= "Content-type: text/html\r\n";
    $result = mail($strEmail, $strSubject, $strContent, $strHeader);

    if ($result == false)
    {
        addMessageToMessageDiv("Something went wrong sending the registering email. Please try again later");
    }
    if ($result == true)
    {
        addMessageToMessageDiv("Registratie email verzonden!");
    }
}

?>