<?php

function getCalendarPrefs($strView, $day)
{
    return array
        (
        'show_next_prev' => TRUE,
        'next_prev_url' => "/index.php/planning?view=$strView&day=$day",
        'start_day' => 'monday',
        'month_type' => 'long',
        'day_type' => 'short',
        "template" =>
        "{table_open}<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" id = \"calendar\">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}

            {heading_previous_cell}<th><a href=\"{previous_url}\">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan=\"{colspan}\">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href=\"{next_url}\">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}

            {cal_cell_content}<a href=\"{content}\">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class=\"highlight\"><a href=\"{content}\">{day}</a></div>{/cal_cell_content_today}

            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class=\"highlight\">{day}</div>{/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}"
    );
}

function splitPlanning($strPlanning)
{
    $arrStrings = explode("/", $strPlanning);
    $arrPlanning = array();
    foreach($arrStrings as $strExploded)
    {
        $arrSplitted = explode("-", $strExploded);
        $arrPlanning[$arrSplitted[0]] = $arrSplitted[1];
    }
    return $arrPlanning;
}

function getPlanningDate()
{
    if(isset($_GET["day"]))
    {$strDay = $_GET["day"];}
    else
    {$strDay = date("d");}
    if(isset($_GET["month"]))
    {$strMonth = $_GET["month"];}
    else
    {$strMonth = date("m");}
    if(isset($_GET["year"]))
    {$strYear = $_GET["year"];}
    else
    {$strYear = date("Y");}
    
    return array("phpdate" => date("Y/m/d", strtotime("$strYear/$strMonth/$strDay")), "normaldate" => strftime("%A %e %B %Y", strtotime("$strYear/$strMonth/$strDay")),
                     "day" => $strDay, "month" => $strMonth, "year" => $strYear);
    
}

function getCalendar($strDay, $strMonth, $strYear, $strPhpDate)
{
    $arrPrefs = getCalendarPrefs("day", $strDay);
    $CI =& get_instance();
    $CI -> load -> library("calendar", $arrPrefs);
    $arrData = array();
    for ($i = 1; $i < 32; $i++)
    {$arrData[$i] = "?view=day&day=$i&month=$strMonth&year=$strYear";}

    return $CI -> calendar -> generate(date("Y", strtotime($strPhpDate)), date("n", strtotime($strPhpDate)), $arrData);
}

function getPartialPlanning($arrDate, $intPartOfDay)
{
    switch($intPartOfDay)
    {
        case 0:
            $strPartOfDay = "Ochtend: ";
            break;
        case 1:
            $strPartOfDay = "Middag: ";
            break;
        case 2:
            $strPartOfDay = "Avond: ";
    }
    $strTable = "";
    $intItem = 1;
    $result = getDataBaseData("planningsitems", array("planningsitem_date" => date("Y-m-d", strtotime($arrDate["phpdate"])), "planningsitem_time" => $intPartOfDay));
    if($result != false)
    {
        while ($arrPlanningData = mysql_fetch_assoc($result))
        {
            $arrUserData = mysql_fetch_assoc(getDataBaseData("users", array("user_id" => $arrPlanningData["planningsitem_user"])));
            
            $strTable .= "
                <table>
                    <thead>
                        <tr>
                            <td colspan = 2>
                                $strPartOfDay".$arrUserData["user_firstname"]." ".$arrUserData["user_lastname"]."
                                <mark style = \"background-color: transparent; cursor: pointer;\"
                                      onclick = \"deleteItem('".$arrPlanningData["planningsitem_id"]."&day=".$arrDate["day"]."&month=".$arrDate["month"]."&year=".$arrDate["year"]."');\">
                                    Verwijder planningsitem
                                </mark>
                            </td>
                        </tr>
                    </thead>
                    <tbody>";
            
            $arrItems = splitPlanning($arrPlanningData["planningsitem_planning"]);
            
            foreach($arrItems as $strTime => $intClientId)
            {
                $arrClientData = mysql_fetch_assoc(getDataBaseData("clients", array("client_id" => $intClientId)));
                
                $strTable .= "
                        <tr>
                            <td>$strTime</td>
                            <td>
                                <a href =\"/index.php/clienten?client_id=$intClientId\">
                                    ".$arrClientData["client_firstname"]." ".$arrClientData["client_lastname"]."
                                </a>
                            </td>
                        </tr>";
            }
            if($arrPlanningData["planningsitem_notitie"] != "")
            {
                $strTable .= "
                        <tr>
                            <td colspan = 2>".$arrPlanningData["planningsitem_notitie"]."</td>
                        </tr>";
            }
            $strTable .= "
                    </tbody>";
            $strTable .= "
                </table>";
            $intItem++;
        }
    }
    else
    {
        $strTable = "
                <table>
                    <thead>
                        <tr>
                            <td>
                                Nog geen planning voor dit deel van de dag.
                            </td>
                        </tr>
                    </thead>
                </table>";
    }
    return $strTable;
}

function deletePlanning()
{
    deleteFromDataBase("planningsitems", "planningsitem_id", $_GET["id"]);
}

function addPlanning()
{
    $intResponsibleUser = $_POST["user"];
    $intTimeOfDay = $_POST["timeOfDay"];
    $strNotes = $_POST["notes"];
    $arrDate = getPlanningDate();
    if($intResponsibleUser != "na" && $intTimeOfDay != "na")
    {
        if(isset($_POST["planning_time_1"]) && $_POST["planning_time_1"] != "" &&
           isset($_POST["planning_client_1"]) && $_POST["planning_client_1"] != "na")
        {
            $strPlanning = $_POST["planning_time_1"]."-".$_POST["planning_client_1"]."/";
            
            $i = 2;
            $blnWork = true;
            while($blnWork == true)
            {
                if(isset($_POST["planning_time_$i"]) && $_POST["planning_time_$i"] != "" &&
                   isset($_POST["planning_client_$i"]) && $_POST["planning_client_$i"] != "na")
                {
                    $strPlanning .= $_POST["planning_time_$i"]."-".$_POST["planning_client_$i"]."/";
                    $i++;
                }
                else
                {$blnWork = false;}
            }
            $strPlanning = rtrim($strPlanning, "/");
            insertDataBaseData("planningsitems", array("planningsitem_user" => $intResponsibleUser, "planningsitem_date" => $arrDate["phpdate"],
                                                       "planningsitem_time" => $intTimeOfDay, "planningsitem_planning" => $strPlanning,
                                                        "planningsitem_notitie" => $strNotes));
        }
        else
        {echo "<script>alert(\"Niet ingegeven, moet minstens 1 item ingeven.\");</script>";}
    }
    else
    {echo "<script>alert(\"Niet ingegeven, u hebt geen tijdstip of verantwoordelijke user opgegeven.\");</script>";}
}