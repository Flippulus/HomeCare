<?php

class Rapportage_Model extends CI_Model
{
    function getReportData($arrMainMenuItems, $strActiveMenu)
    {
        $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
        $strContent.="";
        $result = getDataBaseData("reports");
        
        $strContent .="
            <table class='topic'>";
        
        if($result == null)
        {
            $strContent .="
                <tr>
                    <td>
                        Er zijn  nog geen rapportages in de database.
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
                        $arrTopicData["report_b_user"]."
                    </td>
                </tr>";
            }                   
        }
        
        else
        {
            $strContent .="
                <tr>
                    <td>
                        Error: Er zijn momenteel problemen met de database. Probeer later opnieuw.
                        De database kan even offline zijn.
                    </td>
                </tr>";
        }
        $strContent .="
            </table>";
        
        $strContent .= $this->build_inputArea();
        $strContent .= build_footer();
        
        return $strContent;
    }
    function build_inputArea(){
    $strData="<form name=\"input\" action=\"html_form_action.asp\" method=\"get\">
            <textarea name=\"description\" id=\"description\" cols=\"100\" rows=\"8\" maxlength=\"2048\" wrap=\"soft\" style=\"resize: none\"></textarea>          
            <div id=\"characterLeft\"></div>
            <br/>
            <input type=\"submit\" value=\"Submit\">
            </form> ";
    
    return $strData;
    }
}
?>