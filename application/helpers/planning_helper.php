<?php

function getCalendarPrefs()
{
    return array
        (
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

function createPlanningTable($date)
{
    
    $intDay = date("d", strtotime($date));
    
    $arrPlanning = mysql_fetch_assoc(getDataBaseData("planning", array("planning_date" => date("Y-m-d", strtotime($date)))));
    $arrUser1 = mysql_fetch_assoc(getDataBaseData("users", array($arrPlanning["planning_morning_user"])));
    $arrUser2 = mysql_fetch_assoc(getDataBaseData("users", array($arrPlanning["planning_noon_user"])));
    $arrUser3 = mysql_fetch_assoc(getDataBaseData("users", array($arrPlanning["planning_evening_user"])));
    $strTable = "
        <!-- Start Planning Table -->
            <table id = \"dayplanningcontainer\">
                <tr>
                    <th>
                        <a href = \"/index.php/planning?view=day&day=" . ($intDay - 1) . "\">Gisteren</a>
                    </th>
                    <th>
                        Vandaag: " . date("d/m/Y") . "
                    </th>
                    <th>
                        <a href = \"/index.php/planning?view=day&day=" . ($intDay + 1) . "\">Morgen</a>
                    </th>
                </tr>
                <tr>
                    <td>Ochtend: ".$arrUser1["user_firstname"]." ".$arrUser1["user_lastname"]."</td>
                </tr>
                <tr id = \"morning_data\">
                    
                </tr>
                <tr>
                    <td>Middag: ".$arrUser2["user_firstname"]." ".$arrUser2["user_lastname"]."</td>
                </tr>
                <tr id = \"noon_data\">
                    
                </tr>
                <tr>
                    <td>Avond: ".$arrUser3["user_firstname"]." ".$arrUser3["user_lastname"]."</td>
                </tr>
                <tr id = \"evening_data\">
                    
                </tr>
            </table>";

    return $strTable;
}

function getPlanning($strDayTime, $arrDayData)
{
    $strPlanning = $arrDayData["planning_".$strDayTime];
    $arrStrings = explode("/", $strPlanning);
    $arrPlanning = array();
    foreach($arrStrings as $strExploded)
    {
        $arrSplitted = explode("-", $strExploded);
        $arrPlanning[$arrSplitted[0]] = $arrSplitted[1];
    }
    return $arrPlanning;
}