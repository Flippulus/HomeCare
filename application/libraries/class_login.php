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

class Class_Login
{

    public function login($strPassword, $arrUserData)
    {
        //Admin part, not for clients
        if ($arrUserData["password"] == $strPassword)
        {
            $_SESSION['useremail'] = $arrUserData["mail"];
            $_SESSION['userid'] = $arrUserData["id"];
            $_SESSION["firstname"] = $arrUserData["firstname"];
            $_SESSION["lastname"] = $arrUserData["lastname"];
            return true;
        }
        else
        {
            return false;
        }
    }

    public function logoff()
    {
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['useremail']);
        unset($_SESSION['userid']);
    }

    public function encryptPassword($strUserMail, $strPassword)
    {
        $strSalt = strstr($strUserMail, '@', true) . substr(strstr($strUserMail, '@'), 1);
        $strSalt = strstr($strSalt, '.', true) . substr(strstr($strSalt, '.'), 1);
        $strSalt = str_rot13($strSalt);
        $strEncryptedPassword = md5($strPassword . $strSalt);
        return $strEncryptedPassword;
    }

    public function checkLogin()
    {
        if (isset($_SESSION["firstname"]) and isset($_SESSION["lastname"]) and isset($_SESSION["useremail"]) and isset($_SESSION["userid"]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function authentication()
    {
        if (isset($_POST["frmLogOn"]))
        {
            if (!empty($_POST["login_mail"]))
            {
                if (!empty($_POST["login_pass"]))
                {
                    $strUserMail = $_POST["login_mail"];
                    $strPassword = $_POST["login_pass"];
                    //ecnrypt the password
                    $strEncryptPassword = encryptPassword($strUserMail, $strPassword);
                    //Get user data from DB
                    $result = getDataBaseData("users", array("mail" => $strUserMail));
                    if ($result != false)
                    {
                        if (login($strEncryptPassword, mysql_fetch_assoc($result)) == true)
                        {
                            return true;
                        }
                        else
                        {
                            return "incorrectpass";
                        }
                    }
                    else
                    {
                        return "incorrectmail";
                    }
                }
                else
                {
                    return "nopass";
                }
            }
            else
            {
                return "nomail";
            }
        }
        else
        {
            return "notset";
        }
    }

}

?>