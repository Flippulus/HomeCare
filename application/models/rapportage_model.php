<?php

class Rapportage_Model extends CI_Model
{
    function getReportData($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu)
    {
        $strSql="SELECT * FROM reports 
            LEFT JOIN users ON reports.reported_by_user=users.user_id 
            ORDER BY report_id DESC";
        
        $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
        $strContent.="";
        $result = mysql_query($strSql);
        $strContent .="    
        <div class='homecaretable'>
            <table id='reportTable'>
                <thead>
                    <tr>
                        <td colspan='4'>Rapportages</td>
                    </tr>
                </thead>
                <tbody>";
        
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
                        <td >".
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
                            <a href='/index.php/rapportage?report_id=".$arrTopicData["report_id"]."'>Edit</a>
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
                </tbody>
            </table>
        </div>";
        
        $strContent .= build_footer();
        
        return $strContent;
    }
    
    function updateReportData($arrMainMenuItems, $strActiveMenu, $strId, $arrSubMenuItems, $strActiveSubMenu)
    {
        $strSql="SELECT * FROM reports 
            LEFT JOIN users ON reports.reported_by_user=users.user_id 
            ORDER BY report_id DESC";
        
        
        $strContent = "
            </head>
                <body onload='start();'>";
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
         
        $strContent.="";
        $result = mysql_query($strSql);
        $strContent .="
            <div class='homecaretable'>
                <table>";
        while(($arrTopicData = mysql_fetch_assoc($result)))
        {
            if($arrTopicData["report_id"]==$strId)
            {
                $strContent .="
                    <thead>
                        <tr>
                            <td>Update de rapportage</td>
                        </tr>
                    </thead>
                    </tbody>
                        <tr>
                            <td>".
                            $this->build_updateArea($arrTopicData["report_content"]).
                                "
                            </td>
                        </tr>
                    </tbody>
                </table>";
            }
        }
        $strContent.="</div>";
        
        $strContent .= build_footer();
            return $strContent;
    }
    
    function build_inputArea($arrMainMenuItems, $strActiveMenu,$arrSubMenuItems,$strActiveSubMenu) {
        $strContent = "
            </head>
                <body onload='start();'>";
        
        $strContent .= build_main_menu($arrMainMenuItems, $strActiveMenu);
        $strContent .= buildSubMenu($arrSubMenuItems, $strActiveSubMenu);
        
        $strContent.="
                    <div class='homecaretable'>
                        <table>
                            <thead>
                                <tr>
                                    <td>Voeg een nieuwe rapportage toe</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form name='report_input'  method='post'>
                                            <textarea name='report_content' id='description' cols='95' rows='8' maxlength='2048' wrap='soft' style='resize: none'></textarea>          
                                            <div id='characterLeft'></div>
                                            <br/>
                                            <input type='submit' value='Submit' name='frmSubmitReport'>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>";

        return $strContent;
    }
    
    function build_updateArea($report_content) {
        $strData = "
                            <form name='report_update'  method='post'>
                                <textarea name='report_update' id='description' cols='95' rows='8' maxlength='2048' wrap='soft' style='resize: none'>$report_content</textarea>          
                                <div id='characterLeft'></div>
                                <br/>
                                <input type='submit' value='Submit' name='frmEditReport'>
                            </form>";

        return $strData;
    }
}
?>