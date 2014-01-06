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
            
        }
        else
        {
            echo $CI -> upload -> display_errors();
        }
    }
    else
    {
        $CI -> load -> library("upload", getUploadConfig("clients", $intClientId));
    }
}