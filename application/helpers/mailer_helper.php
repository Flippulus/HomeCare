<?php


function mailto($strSubject, $strEmail, $strContent)
{
    $strWebMaster = "admin@rimiclacihomecare.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    return mail($strEmail, $strSubject, $strContent, $headers);
}