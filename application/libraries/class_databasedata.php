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

class Class_DatabaseData
{

    public function getDataBaseData($strTable, $arrParameters = false)
    {
        if ($arrParameters != false)
        {
            $strSql = "SELECT * FROM " . $strTable . " WHERE ";
            foreach ($arrParameters as $strParameter => $strParamValue)
            {
                if ($strParamValue != end($arrParameters))
                {
                    $strSql .= $strParameter . " = \"" . $strParamValue . "\" AND ";
                }
                else
                {
                    $strSql .= $strParameter . " = \"" . $strParamValue . "\"";
                }
            }


            $result = mysql_query($strSql);
        }
        else
        {
            $strSql = "SELECT * FROM " . $strTable;
            $result = mysql_query($strSql);
        }
        if (!$result)
        {
            return false;
        }
        elseif (mysql_num_rows($result) == 0)
        {
            return false;
        }
        else
        {
            return $result;
        }
    }

    public function getDataBaseDataWithExtra($strTable, $strExtraReturn, $strParameter = false, $strParamValue = false)
    {
        if ($strParameter != false and $strParamValue != false)
        {
            $strSql = "SELECT *, " . $strExtraReturn . " FROM " . $strTable . " WHERE " . $strParameter . " = \"" . $strParamValue . "\"";
            $result = mysql_query($strSql);
        }
        else
        {
            $strSql = "SELECT * FROM " . $strTable;
            $result = mysql_query($strSql);
        }
        if (!$result)
        {
            return false;
        }
        elseif (mysql_num_rows($result) == 0)
        {
            return false;
        }
        else
        {
            return $result;
        }
    }

    public function insertDataBaseData($strTable, $arrParameters)
    {

        $strSql1 = "
        INSERT INTO " . $strTable . " (";

        $strSql2 = "
        VALUES (";

        foreach ($arrParameters as $strParameter => $strParamValue)
        {
            if ($strParamValue != end($arrParameters))
            {
                $strSql1 .= $strParameter . ", ";
                $strSql2 .= "\"" . $strParamValue . "\", ";
            }
            else
            {
                $strSql1 .= $strParameter . ")";
                $strSql2 .= "\"" . $strParamValue . "\")";
            }
        }
        $strSql = $strSql1 . $strSql2;
        $result = mysql_query($strSql);

        if (!$result or $result == false)
        {
            exit(mysql_error());
        }
        else
        {
            return true;
        }
    }

    function deleteFromDataBase($strTable, $strParam, $strParamValue)
    {
        $strSql = "DELETE FROM " . $strTable . " WHERE " . $strParam . " = \"" . $strParamValue . "\"";
        $result = mysql_query($strSql);
        if (!$result)
        {
            
        }
        else
        {
            return true;
        }
    }

    public function changeDataBaseRecord($strTable, $arrValues, $strParam, $strParamValue)
    {
        $strSql = "UPDATE " . $strTable;
        $strSql .= " SET ";
        foreach ($arrValues as $strRow => $strValue)
        {
            if ($strValue != end($arrValues))
            {
                $strSql .= $strRow . " = \"" . $strValue . "\", ";
            }
            else
            {
                $strSql .= $strRow . " = \"" . $strValue . "\" ";
            }
        }

        $strSql .= "WHERE " . $strParam . " = \"" . $strParamValue . "\"";
        $result = mysql_query($strSql);
        if ($result == false)
        {
            
        }
        else
        {
            return true;
        }
    }

}

?>