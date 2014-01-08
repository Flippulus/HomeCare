<?php


function getUploadConfig($strType, $strDir)
{
    if ($strDir == false)
    {
        return array(
            'upload_path' => realpath(APPPATH . '../documents/'.$strType),
            'upload_url' => realpath(APPPATH . '../documents/'.$strType),
            'allowed_types' => "txt|doc|docx|xls|xlsx|ppt|pps|pptx|ppsx|pdf|png|jpeg|jpg|gif|bmp",
            'overwrite' => TRUE,
            'max_size' => "5000KB"
        );
    }
    else
    {
        return array(
            'upload_path' => realpath(APPPATH . '../documents/'.$strType.'/'.$strDir),
            'upload_url' => realpath(APPPATH . '../documents/'.$strType.'/'.$strDir),
            'allowed_types' => "txt|doc|docx|xls|xlsx|ppt|pps|pptx|ppsx|pdf|png|jpeg|jpg|gif|bmp",
            'overwrite' => TRUE,
            'max_size' => "5000KB"
        );
    }
}

function uploadFile($strAction, $intClientId = 1)
{
    $CI =& get_instance();
    
    if($strAction == "general")
    {
        $CI -> load -> library("upload", getUploadConfig("general", $_POST["selectedmap"]));
        if($CI -> upload -> do_upload())
        {
            $result = getDataBaseData("documents", array("doc_name" => $CI -> upload -> file_name, "doc_map" => $_POST["selectedmap"]));
            if($result != false)
            {
                $arrDocData = mysql_fetch_assoc($result);
                deleteFromDataBase("documents", "doc_id", $arrDocData["doc_id"]);
            }
            insertDataBaseData("documents", array("doc_name" => $CI -> upload -> file_name, "doc_map" => $_POST["selectedmap"],
                                                   "doc_size" => $CI -> upload -> file_size, "doc_type" => $CI -> upload -> file_ext));
        }
        else
        {
            echo $CI -> upload -> display_errors();
        }
    }
    else
    {
        $CI -> load -> library("upload", getUploadConfig("clients", $intClientId));
        if($CI -> upload -> do_upload())
        {
            $result = getDataBaseData("documents", array("doc_name" => $CI -> upload -> file_name, "doc_about_client" => $intClientId));
            if($result != false)
            {
                $arrDocData = mysql_fetch_assoc($result);
                deleteFromDataBase("documents", "doc_id", $arrDocData["doc_id"]);
            }
            insertDataBaseData("documents", array("doc_name" => $CI -> upload -> file_name, "doc_about_client" => $intClientId,
                                                   "doc_size" => $CI -> upload -> file_size, "doc_type" => $CI -> upload -> file_ext));
        }
        else
        {
            echo $CI -> upload -> display_errors();
        }
    }
}

function removeFile($intId)
{
    $arrDocData = mysql_fetch_assoc(getDataBaseData("documents", array("doc_id" => $intId)));
    
    if($arrDocData["doc_about_client"] == 0)
    {
        $strDir = $arrDocData["doc_map"];
        $strFileName = $arrDocData["doc_name"];
        try
        {
            if(unlink("documents/general/$strDir/$strFileName") == true)
            {deleteFromDataBase("documents", "doc_id", $intId);}
        }
        catch(Exception $e)
        {echo "<script>alert(\"Verwijderen van bestand mislukt. Verwittig de server-admin.\");</script>";}
    }
    else
    {
        //Code voor Rob's files
    }
}

function addMap($strMapName)
{
    try
    {
        if(mkdir("documents/general/$strMapName") == true)
        {insertDataBaseData("docmaps", array("doc_name" => $strMapName));}
        else
        {echo "<script>alert(\"Aanmaken van map mislukt. Verwittig de server-admin.\");</script>";}
    }
    catch (Exception $ex)
    {echo "<script>alert(\"Aanmaken van map mislukt. Verwittig de server-admin.\");</script>";}
}

function deleteMap($strMapName)
{
    if(rmdir("documents/general/$strMapName" == true))
    {
        deleteFromDataBase("docmaps", "doc_name", $strMapName);
    }
    else
    {
        echo "<script>alert(\"Verwijderen van bestand mislukt. Verwittig de server-admin.\");</script>";
    }
}