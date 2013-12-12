<?php

class Rapportage_Model extends CI_Model
{
    function getReportData($arrMainMenuItems, $strActiveMenu)
    {
        $strSql="SELECT * FROM reports 
            LEFT JOIN users ON reports.reported_by_user=users.user_id 
            ORDER BY report_id DESC";
        
        $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
        $strContent.="";
        $result = mysql_query($strSql);
        $strContent .="
            <table class='topic'  style = 'border: 1px #000000 solid;'>";
        
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
            while($arrTopicData = mysql_fetch_assoc($result))
            {
                $strContent .="
                    <tr>
                        <td>".
                            $arrTopicData["report_content"]."
                        </td>
                        <td>".
                            "at:".$arrTopicData["report_datetime"]."
                        </td>
                        <td>".
                            "by:". $arrTopicData["user_firstname"]."
                        </td>";
                
                if ($_SESSION['userid']==$arrTopicData["user_id"])
                {
                    $strContent.="
                        <td>
                            <a href='/index.php/rapportage?report_id=".$arrTopicData["report_id"]."'>link</a>
                        </td>
                    </tr>";
                }
                else{$strContent.="
                        <td>
                        </td>
                    </tr>";}
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
    
    function updateReportData($arrMainMenuItems, $strActiveMenu, $strId)
    {
        $strSql="SELECT * FROM reports 
            LEFT JOIN users ON reports.reported_by_user=users.user_id 
            ORDER BY report_id DESC";
        
        
        $strContent = "
            </head>
                <body>";
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        
         
        $strContent.="";
        $result = mysql_query($strSql);
        $strContent .="
            <table class='topic'  style = 'border: 1px #000000 solid;'>";
        while(($arrTopicData = mysql_fetch_assoc($result)))
        {
            if($arrTopicData["report_id"]==$strId)
            {
                $strContent .="
                <table>
                    <tr>
                        <td>
                            <form name='edit_report'  method='post'>".
                            $this->build_updateArea($arrTopicData["report_content"]).
                            "</form>
                        </td>
                    </tr>
                </table>";
            }
        }
        
        $strContent .= build_footer();
            return $strContent;
    }
    
    function build_inputArea() {
        $strData = "
            <form name='report_input'  method='post'>
                <textarea name='report_content' id='report_content' cols='100' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>          
                <div id='characterLeft'></div>
                <br/>
                <input type='submit' value='Submit' name='frmSubmitReport'>
            </form> ";

        return $strData;
    }
    
    function build_updateArea($report_content) {
        $strData = "
            <form name='report_input'  method='post'>
                <textarea name='update_content' id='update_content' cols='100' rows='8' maxlength='2048' wrap='soft' style='resize: none'>$report_content</textarea>          
                <div id='characterLeft'></div>
                <br/>
                <input type='submit' value='Submit' name='frmEditReport'>
            </form> ";

        return $strData;
    }
}
?>