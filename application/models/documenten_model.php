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
                    <form method = \"POST\" enctype = \"multipart/form-data\" >
                        Select File To Upload:
                        <br>
                        <input type = \"file\" name = \"userfile\" />
                        <br>
                        <input type = \"submit\" name = \"frmFileUpload\" value = \"Uploaden\" />
                        <input type = \"hidden\" id = \"selectedmap\" name = \"selectedmap\" value = \"root\">
                        <input type = \"hidden\" id = \"selecteddoc\" name = \"selecteddoc\" value = \"\">
                    </form>
                </div>
                <div id = \"file_info\">
                    
                </div>
                <div id = \"documents_container\">";
        $strJs = "
                <script>
                    var arrDocs = [";
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
                        <li class = \"map\" id = \"map_$strMap\" onclick = \"selectmap(this);\">$strMap</li>";
                    
                    if(!empty($arrDoc))
                    {
                        $strContents .= "
                        <ul id = \"map_$strMap\" class = \"docs\">";
                        
                        foreach ($arrDoc as $intId => $strDoc)
                        {
                            $arrDocType = split(".", $strDoc);
                            $strDocName = $arrDocType[0];
                            $strDocType = $arrDocType[1];
                            $strContents .= "
                            <li class = \"doc\" id = \"doc_$intId\" onclick = \"selectdoc(this);\">$strDoc</li>";
                            $strJs .= "[$intId, $strDoc]";
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
                        <li class = \"doc\" id = \"doc_$intId\" onclick = \"selectdoc(this);\">$strDoc</li>";
                    }
                }
            }
            
            $strContents .= "
                    </ul>";
        }
        $strContents .= "            
                </div>";
        
        $strJs .= "
            </script>";
        
        $strContents .= $strJs;

        $strContents .= build_footer();
        return $strContents;
    }

}