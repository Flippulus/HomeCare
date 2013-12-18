<?php

function post_report($content,$by, $client="0") 
{
    /*
     * $report_id
     * $report_client
     * $report_datetime
     * $report_content
     * $reported_by_user
     */
    
    
    if($content==null)
    {
        echo"Er werd niets naar de database weggeschreven";
        echo"<br/>";
        echo"reden: de input was leeg";
    }
    else
    {        
        if ($client == "0")
        {
            $time=date("Y-m-d H:i:s"); 
            $sql = "INSERT INTO reports (report_client,report_datetime,report_content,reported_by_user)
                VALUES ('".$client."','".  $time."','".strip_tags($content)."','".$by."')";
            mysql_query($sql);
        }
        else
        {}
    }
 }  
 
 function Update_report($content, $report_id, $client = "0")
 {
    if ($content == null) 
    {
        echo"Er werden geen gegevens geupdate";
        echo"<br/>";
        echo"reden: de input was leeg";
    } 
    else 
    {
        if ($client == "0") 
        {
            $time = date("Y-m-d H:i:s");
            $sql = "UPDATE reports 
                SET report_content= '".strip_tags($content)."', report_datetime='".$time."'
                WHERE report_id ='$report_id'";
            mysql_query($sql);
        }
        else
        {}
    }
}


?>
