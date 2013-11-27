<?php

class Rapportage_Model extends CI_Model
{
    function getReportData($arrMainMenuItems, $blnLoggedOn,$strActiveMenu)
    {
        $strContent = "
            </head>
                <body>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $blnLoggedOn, $strActiveMenu);
        
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
                        $arrTopicData["report_id"]."
                    </td>
                    <td>".
                        $arrTopicData["report_client"]."
                    </td>
                    <td>".
                        $arrTopicData["report_datetime"]."
                    </td>
                    <td>".
                        $arrTopicData["report_content"]."
                    </td>
                    <td>".
                        $arrTopicData["report_by_user"]."
                    </td>
                </tr>";
            }                   
        }
        
        else
        {
            $strContent .="
                <tr>
                    <td>
                        I can't believe this is not an error o.O
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
