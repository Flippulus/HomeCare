<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function saveAccount($strType)
{
    if($strType == "register_team")
    {
        if(isset($_POST["frmAddUser"]))
        {
            if(!empty($_POST["user_email"]))
            {
                $intActivationNumber = rand(100000, 1000000);
                $strMail = $_POST["user_email"];
                $strContent = "
                    <h1>Welkom bij Homecare, de site voor Thuiszorg Maasland!</h1>
                    <p>Deze mail komt van een collega van bij de thuiszorg en nodigt u uit
                    om u aan te melden bij de website!</p>
                    <a href = \"www.rimiclacihomecare.co.nf/index.php/activateaccount?id=$intActivationNumber\">
                        Klik hier om uw account aan te maken!
                    </a>";
                if(mailto("Registratie Homecare", $strMail, $strContent) != false)
                {
                    insertDataBaseData("users", array("user_mail" => $strMail, "user_activated" => $intActivationNumber));
                    
                }
            }
        }
    }
}