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
                <div id = \"file_info\">
                </div>
                <div id = \"documents_container\">
                    <div id = \"doc_list\">";
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
                if($strMap != "root")
                {
                    $strContents .= "
                        <li class = \"map\" id = \"map_$strMap\" onclick = \"selectmap(this);\">$strMap</li>";
                    
                    if(!empty($arrDoc))
                    {
                        $strContents .= "
                        <ul id = \"map_$strMap\" class = \"docs\">";
                        
                        foreach ($arrDoc as $intId => $strDoc)
                        {
                            $arrDocType = preg_split('/[.]/', $strDoc);
                            $strDocName = $arrDocType[0];
                            $strDocType = $arrDocType[1];
                            $strContents .= "
                            <li class = \"doc\" id = \"doc_$intId\" onclick = \"selectdoc(this);\">$strDocName</li>";
                            $strJs .= "[$intId, '$strDocName', '$strDocType', '$strMap'], ";
                        }
                        $strContents .= "
                        </ul>";
                    }
                }
            }
            
            foreach($arrContents as $strMap => $arrDoc)
            {
                if($strMap == "root")
                {
                    foreach($arrDoc as $intId => $strDoc)
                    {
                        $arrDocType = preg_split('/[.]/', $strDoc);
                        $strDocName = $arrDocType[0];
                        $strDocType = $arrDocType[1];
                        $strContents .= "
                        <li class = \"doc\" id = \"doc_$intId\" onclick = \"selectdoc(this);\">$strDocName</li>";
                        $strJs .= "[$intId, '$strDocName', '$strDocType', 'root'], ";
                    }
                }
            }
            
            $strContents .= "
                    </ul>";
        }
        else
        {
            $strContents .= "
                    <ul class = \"maps\">";
            
            foreach($arrContents as $strMap => $arrEmpty)
            {
                $strContents .= "
                        <li class = \"map\" id = \"map_$strMap\" onclick = \"selectmap(this);\">$strMap</li>";
            }
            
            $strContents .= "
                    </ul>";
        }
        $strContents .= "
                    </div>
                    <div id = \"upload\">
                        <form method = \"POST\" enctype = \"multipart/form-data\" >
                            Kies een bestand om te uploaden:
                            <br>
                            <input type = \"file\" name = \"userfile\" />
                            <br>
                            <input type = \"submit\" name = \"frmFileUpload\" value = \"Uploaden\" />
                            <input type = \"hidden\" id = \"selectedmap\" name = \"selectedmap\" value = \"root\">
                            <input type = \"hidden\" id = \"selecteddoc\" name = \"selecteddoc\" value = \"\">
                        </form>
                    </div>
                </div>";
        
        $strJs .= "];
            </script>";
        
        $strContents .= $strJs;

        $strContents .= build_footer();
        return $strContents;
    }

}