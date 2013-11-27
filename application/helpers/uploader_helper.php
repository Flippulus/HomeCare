<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
