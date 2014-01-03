<?php


Class Documenten_Model extends CI_Model
{

    function getPageData($arrMainMenuItems, $strActiveMenu)
    {
        $strContents = "
            </head>
            <body>";
        $strContents.=build_main_menu($arrMainMenuItems, $strActiveMenu);

        $strContents.= "
                <div id = \"upload\">
                    <form method=\"POST\" enctype=\"multipart/form-data\" >
                        Select File To Upload:
                        <br />
                        <input type=\"file\" name=\"userfile\" />
                        <br />
                        <input type=\"submit\" name=\"frmFileUpload\" value=\"Uploaden\" />
                    </form>
                </div>
                <div id = \"documents_container\">";
        
        $result2 = getDataBaseData("docmaps");
        
        while($arrMapNames = mysql_fetch_assoc($result2))
        {
            $arrContents[$arrMapNames["doc_name"]] = array();
        }
        
        $result = getDataBaseData("documents", array("doc_about_client" => 0));
        
        if($result != false)
        {
            while($arrDocData = mysql_fetch_assoc($result))
            {
                $arrContents[$arrDocData["doc_map"]][$arrDocData["doc_id"]] = $arrDocData["doc_name"];
            }
            
            $strContents .= "
                    <ul class = \"maps\">";
            
            foreach($arrContents as $strMap => $arrDoc)
            {
                if($strMap != "")
                {
                    $strContents .= "
                        <li id = \"map_$strMap\">$strMap</li>";
                    
                    if(!empty($arrDoc))
                    {
                        $strContents .= "
                        <ul class = \"docs\">";
                        
                        foreach ($arrDoc as $intId => $strDoc)
                        {
                            $strContents .= "
                            <li id = \"doc_$intId\">$strDoc</li>";
                        }
                        $strContents .= "
                        </ul>";
                    }
                    
                }
            }
            
            foreach($arrContents as $strMap => $arrDoc)
            {
                if($strMap == "")
                {
                    foreach($arrDoc as $intId => $strDoc)
                    {
                        $strContents .= "
                        <li id = \"doc_$intId\">$strDoc</li>";
                    }
                }
            }
            
            $strContents .= "
                    </ul>";
        }
        $strContents .= "            
                </div>";
        

        $strContents .= build_footer();
        return $strContents;
    }

}