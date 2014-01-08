<?php


class Home_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        
        $strSqlUser = "SELECT *
                    FROM users 
                    WHERE user_id=(
                    SELECT max(user_id) FROM users
                    )";
        
        $strSqlClient = "SELECT *
                    FROM clients 
                    WHERE client_id=(
                    SELECT max(client_id) FROM clients
                    )";
        
        $resultUser = mysql_query($strSqlUser);
        $resultClient = mysql_query($strSqlClient);
                
        $arrUserData = mysql_fetch_assoc($resultUser);
        $arrClientData = mysql_fetch_assoc($resultClient);
        
        $strContents = "
            </head>
            <body>";
        
        
        
        if($arrUserData["user_firstname"] == "")
        {
           $arrUserData["user_firstname"] == $arrUserData["user_mail"];
        }
        
        
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
        
        $strContents .= "
            <br/><br/><br/><br/>
            <div class='homecaretable'>
            <table border = '1'>
            <thead><tr><td colspan ='2'>Recente updates</td></tr></thead>
            <tr><td>Laatst toegevoegde cliënten:</td></tr>
            <tr><td><a href = \"http://www.rimiclacihomecare.co.nf/index.php/clienten?client_id=".$arrClientData["client_id"]."\">".$arrClientData["client_firstname"]."</a></td></tr>
            <tr><td><br/></td></tr>
            <tr><td>Laatst toegevoegde verpleegkundigen:</td></tr>
            <tr><td>".$arrUserData["user_firstname"]."</td></tr>
          
            </table>";
      
        
        
		
       // $strContents .= build_footer();
        $strContents .="</div>";
        return $strContents;
    }
    
}