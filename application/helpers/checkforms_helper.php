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

function checkPassword($strPassword, $strPasswordAgain)
{
    if ($strPassword == $strPasswordAgain)
    {
        return true;
    }
}

function addNotes($intBy)
{
    if (isset($_POST["id"]) && isset($_POST["clientNote"]))
    {
        $strContents = strip_tags($_POST["clientNote"]);
        $intAbout = $_POST["id"];
        $strContents = str_replace(array("\r", "\n", "\r\n"), "<br>", $strContents);
        $date = date("Y-m-d", strtotime("+6 hours"));
        $time = date("H:i:s", strtotime("+6 hours"));
        $arrParameters = array("content" => $strContents, "by_id" => $intBy, "about_id" => $intAbout, "post_date" => $date, "post_time" => $time);
        insertDataBaseData("clientnotes", $arrParameters);
    }
}

function checkLeadVisited()
{
    if (isset($_POST["frmCalledProspect"]) and isset($_GET["id"]))
    {
        $strOption = $_POST["clientstatus"];

        switch ($strOption)
        {
            case "client":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "client";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d");
                $newTime = date("H:i:s");
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "lead":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "lead";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime($_POST["callbacktime"]));
                $newTime = date("H:i:s", strtotime($_POST["callbacktime"]));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "declined":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "prospect";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime("+1 year 6 hours"));
                $newTime = date("H:i:s", strtotime("+1 year 6 hours"));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "prospect":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "prospect";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime($_POST["callbacktime"]));
                $newTime = date("H:i:s", strtotime($_POST["callbacktime"]));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
        }

        //Change the Client into new status
        changeDataBaseRecord("clients", array("status" => $strChangedTo, "contactdate" => $newDate, "contacttime" => $newTime), "id", $strChangedId);
        //Add change to other table, so it can be recalled
        insertDataBaseData("clientchanges", array("changed_id" => $strChangedId, "changed_by" => $intChangedBy,
            "changed_what" => $strChangedWhat, "changed_because" => $strChangedBecause,
            "changed_from" => $strChangedFrom, "changed_to" => $strChangedTo,
            "note" => $strNote, "date" => $changeDate, "time" => $changeTime));
        return true;
    }
    else
    {
        return false;
    }
}

//All offer functions start
function checkOfferCalled()
{
    if (isset($_POST["frmCalledOffer"]) and isset($_GET["id"]))
    {
        if ($_POST["script_quest10"] == "yes")
        //We are speaking to the right person.
        {
            if ($_POST["script_quest20"] == "yes")
            //The addressed is willing to give feedback.
            {
                if ($_POST["script_quest30"] == "yes")
                //The addressed is happy with the offer.
                {
                    if ($_POST["script_quest40"] == "yes")
                    //The addressed has a reply to the offer.
                    {
                        if ($_POST["script_quest41"] == "yes")
                        //The addressed has chosen for the offer to be handled.
                        {
                            offerDoneAccepted();
                        }
                        else
                        {
                            offerDoneDeclined();
                        }
                    }
                    else
                    {
                        offerDoneCallBack();
                    }
                }
                else
                {
                    if ($_POST["script_quest32"] == "yes")
                    //Addressed unsatisfied and client will call back
                    {
                        offerDoneClientCallBack();
                    }
                    else
                    //The addressed does not want the client to call back
                    {
                        if ($_POST["script_quest33"] == "yes")
                        {
                            offerDoneNoCallBackInformative();
                        }
                        else
                        {
                            offerDoneNoCallBack();
                        }
                    }
                }
            }
            else
            {
                offerDoneCallBack();
            }
        }
        else
        {
            offerDoneCallBack();
        }
    }
}

function checkProspectCalled()
{
    if (isset($_POST["frmCalledProspect"]) and isset($_GET["id"]))
    {
        $strOption = $_POST["clientstatus"];

        switch ($strOption)
        {
            case "client":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "client";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d");
                $newTime = date("H:i:s");
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "lead":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "lead";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime($_POST["callbacktime"]));
                $newTime = date("H:i:s", strtotime($_POST["callbacktime"]));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "declined":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "prospect";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime("+1 year 6 hours"));
                $newTime = date("H:i:s", strtotime("+1 year 6 hours"));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
            case "callback":
                $result = getDataBaseData("clients", array("id" => $_GET["id"]));
                $arrUserData = mysql_fetch_assoc($result);
                $strChangedId = $_GET["id"];
                $intChangedBy = $_SESSION["userid"];
                $strChangedWhat = "status";
                $strChangedBecause = "called";
                $strChangedFrom = $arrUserData["status"];
                $strChangedTo = "prospect";
                $strNote = $_POST["note"];
                $newDate = date("Y-m-d", strtotime($_POST["callbacktime"]));
                $newTime = date("H:i:s", strtotime($_POST["callbacktime"]));
                $changeDate = date("Y-m-d", strtotime("+6 hours"));
                $changeTime = date("H:i:s", strtotime("+6 hours"));
                break;
        }

        //Change the Client into new status
        changeDataBaseRecord("clients", array("status" => $strChangedTo, "contactdate" => $newDate, "contacttime" => $newTime), "id", $strChangedId);
        //Add change to other table, so it can be recalled
        insertDataBaseData("clientchanges", array("changed_id" => $strChangedId, "changed_by" => $intChangedBy,
            "changed_what" => $strChangedWhat, "changed_because" => $strChangedBecause,
            "changed_from" => $strChangedFrom, "changed_to" => $strChangedTo,
            "note" => $strNote, "date" => $changeDate, "time" => $changeTime));
        return true;
    }
    else
    {
        return false;
    }
}

function checkAdminAddForm()
{
    //Check if every textbox is filled and every option is chosen
    $_SESSION["arrErrors"] = array();
    $blnError = false;
    $blnSubmitted = false;

    //Check user title
    $result = checkFormItem("user_title", "select");
    if ($result == "ok")
    {
        $blnSubmitted = true;
    }
    if ($result == "empty")
    {
        $blnError = true;
        $blnSubmitted = true;
    }

    //Check last name
    $result = checkFormItem("user_lastname", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check first name
    $result = checkFormItem("user_firstname", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check streetname
    $result = checkFormItem("user_streetname", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check street number
    $result = checkFormItem("user_streetnumber", "text", false, true);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check postal code
    $result = checkFormItem("user_postal", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check location
    $result = checkFormItem("user_location", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check province
    $result = checkFormItem("user_province", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check country
    $result = checkFormItem("user_country", "text", false, false);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check email
    $result = checkFormItem("user_mail", "text");
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check Phone number
    $result = checkFormItem("user_phone", "text", false, true);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check Cell numer
    $result = checkFormItem("user_cell", "text", false, true);
    if ($result != "ok")
    {
        $blnError = true;
    }

    //Check account type
    $result = checkFormItem("user_level", "select");
    if ($result == "empty" or $result == "notset")
    {
        $blnError == true;
    }
    //End of form checking

    if ($blnSubmitted == true)
    {
        if ($blnError == true)
        {
            return "Error";
        }
        else
        {
            return "Succes";
        }
    }
}

function checkFormItem($strName, $strType, $blnNoNumbers = false, $blnNoLetters = false)
{
    if ($strType == "select")
    {
        if (isset($_POST[$strName]))
        {
            if ($_POST[$strName] == "na")
            {
                $_SESSION["arrErrors"][] = $strName;
                return "empty";
            }
            else
            {
                return "ok";
            }
        }
        else
        {
            return "notset";
        }
    }
    if ($strType == "text")
    {
        if (empty($_POST[$strName]))
        {
            $_SESSION["arrErrors"][] = $strName;
            return "empty";
        }
        else
        {
            if ($blnNoNumbers == true)
            {
                if (!ctype_alpha($_POST[$strName]))
                {
                    $_SESSION["arrErrors"][] = $strName;
                    return "error";
                }
                else
                {
                    return "ok";
                }
            }
            elseif ($blnNoLetters == true)
            {
                if (!ctype_digit($_POST[$strName]))
                {
                    $_SESSION["arrErrors"][] = $strName;
                    return "error";
                }
                else
                {
                    return "ok";
                }
            }
            else
            {
                return "ok";
            }
        }
    }
}

?>