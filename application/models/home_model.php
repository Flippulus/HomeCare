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
        
        $strSqlDocument = "SELECT *
                    FROM documents 
                    WHERE doc_id=(
                    SELECT max(doc_id) FROM documents
                    )";
        
        $strSqlRapportage = "SELECT *
                    FROM reports 
                    WHERE report_id=(
                    SELECT max(report_id) FROM reports WHERE report_client = 0
                    )";
        
        $strSqlClientRapportage = "SELECT *
                    FROM reports 
                    WHERE report_id=(
                    SELECT max(report_id) FROM reports WHERE report_client <> 0
                    )";
        
        $resultUser = mysql_query($strSqlUser);
        $resultClient = mysql_query($strSqlClient);
        $resultDocument = mysql_query($strSqlDocument);
        $resultRapportage = mysql_query($strSqlRapportage);
        $resultClientRapportage = mysql_query($strSqlClientRapportage);
                
        $arrUserData = mysql_fetch_assoc($resultUser);
        $arrClientData = mysql_fetch_assoc($resultClient);
        $arrDocumentData = mysql_fetch_assoc($resultDocument);
        $arrRapportageData = mysql_fetch_assoc($resultRapportage);
        $arrClientRapportageData = mysql_fetch_assoc($resultClientRapportage);
        
        $strContents = "
            </head>
            <body>";
        
        
        
        if($arrUserData["user_firstname"] == "")
        {
           $arrUserData["user_firstname"] = $arrUserData["user_mail"];
        }
        
        
        $strContents .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
        
        $strContents .= "
            <br/><br/><br/><br/>
            <div class='homecaretable'>
            <table border = '1'>
            <thead><tr><td colspan ='2'>Recente updates</td></tr></thead>
            <tr><td>Laatst toegevoegde cliënten:</td><td><a href = \"http://www.rimiclacihomecare.co.nf/index.php/clienten?client_id=".$arrClientData["client_id"]."\">".$arrClientData["client_firstname"]." ".$arrClientData["client_lastname"]."</a></td></tr>
            <tr><td><br/></td><td><br/></td></tr>
            <tr><td>Laatst toegevoegde verpleegkundigen:</td><td><a href =\"http://www.rimiclacihomecare.co.nf/index.php/team\">".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."</a></td></tr>
            <tr><td><br/></td><td><br/></td></tr>
            <tr><td>Laatst toegevoegde documenten:</td><td><a href =\"http://www.rimiclacihomecare.co.nf/index.php/documenten\">".$arrDocumentData["doc_name"]."</a></td></tr>
            <tr><td><br/></td><td><br/></td></tr>
            <tr><td>Laatst toegevoegde algemene rapportage:</td><td><a href =\"http://www.rimiclacihomecare.co.nf/index.php/rapportage\">".$arrRapportageData["report_content"]."</a></td></tr>
            <tr><td><br/></td><td><br/></td></tr>  
            <tr><td>Laatst toegevoegde cliënt rapportage:</td><td><a href =\"http://www.rimiclacihomecare.co.nf/index.php/clienten?client_report=".$arrClientRapportageData["report_client"]."\">".$arrClientRapportageData["report_content"]."</a></td></tr>
            </table>";
      
        
        
		
       // $strContents .= build_footer();
        $strContents .="</div>";
        return $strContents;
    }
    
}