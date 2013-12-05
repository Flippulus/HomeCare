<?php

function post_report($client,$content,$by) 
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
        $time=date("Y-m-d H:i:s"); 
        $sql = "INSERT INTO reports (report_client,report_datetime,report_content,reported_by_user)
            VALUES ('".$client."','".  $time."','".$content."','".$by."')";
        mysql_query($sql);
    }
}

?>
