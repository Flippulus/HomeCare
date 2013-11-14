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

function connect_database()
{
    $server = 'fdb3.biz.nf';  
    $username   = '1537644_homecare';
    $password   = 'eloict147';
    $database   = '1537644_homecare';
    
    if(!mysql_connect($server, $username,  $password))
    {
        exit('Error: could not establish database connection');
    }  
    if(!mysql_select_db($database)) 
    {
        exit('Error: could not select the database');
    }  
    //return $objDB = new PDO("mysql:host=".$server.";dbname=".$database, $username, $password);
 }
 

?>