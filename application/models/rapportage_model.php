<?php

class Rapportage_Model extends CI_Model
{
    function getReportData($arrMainMenuItems, $blnLoggedOn)
    {
        $strContent = "
            </head>
                <body>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $blnLoggedOn);
        
        $strContent.="";
        $result = getDataBaseData("reports");
        
        $strContent .="
            <table class='topic'>";
        
        if($result == null)
        {
            $strContent .="
                <tr>
                    <td>
                        Welp, It's lonely in here ;_;
                    </td>
                </tr>
                <tr>
                    <td>
                        Error: Database seems to be empty.
                    </td>
                </tr>";
        }
        elseif ($result !=false)
        {
            while($arrTopicData == mysql_fetch_assoc($result))
            {
                $strContent .="
                <tr>
                    <td>".
                        $arrTopicData["id"]."
                    </td>
                    <td>".
                        $arrTopicData["user"]."
                    </td>
                    <td>".
                        $arrTopicData["time"]."
                    </td>
                    <td>".
                        $arrTopicData["content"]."
                    </td>
                </tr>";
            }                   
        }
        
        else
        {
            $strContent .="
                <tr>
                    <td>
                        I can't believe this isn't an error o.O
                    </td>
                </tr>
                <tr>
                    <td>
                        Error: unspecified error has appeared. Please try again later.
                        Database might be offline for a moment.
                    </td>
                </tr>";
        }
        $strContent .="
            </table>";
        
        $strContent .= build_footer();
        
        return $strContent;
    }
    
}
?>
