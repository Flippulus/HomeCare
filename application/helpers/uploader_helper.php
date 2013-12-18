<?php


function getUploadConfig($strType, $strDir)
{
    echo realpath(APPPATH . '../documents/'.$strType);
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
