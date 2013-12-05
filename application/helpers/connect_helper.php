<?php

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