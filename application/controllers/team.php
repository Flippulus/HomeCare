<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Class Team extends CI_Controller
{
    function index()
    {
        date_default_timezone_set("Europe/Brussels");
        session_start();
        connect_database();
        //Runs script connecting to the Database
        
        createPageStart("HomeCare", array());
        authentication(); 
        
        
            
        
    }
    
    
}
?>
