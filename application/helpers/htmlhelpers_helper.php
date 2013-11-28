<?php

function createPageStart($strTitle, $arrCss)
{
    $strPageStart = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/strict.dtd\">
<html>
    <head>
        <title>" . $strTitle . "</title>
        <meta http-equiv = \"content-type\" content=\"text/html;charset = utf-8\" />
        <link type = \"text/css\" media = \"screen\" rel = \"stylesheet\" href = \"http://www.rimiclacihomecare.co.nf/css/default.css\"/>
        <link type = \"text/css\" media = \"screen\" rel = \"stylesheet\" href = \"http://www.rimiclacihomecare.co.nf/css/menu.css\"/>
        <link rel=\"shortcut icon\" type=\"image/png\" href=\"http://www.rimiclacihomecare.co.nf/images/faviconHomeCare.png\">
        <script src = \"http://www.rimiclacihomecare.co.nf/javascript/jQuery.js\" type = \"text/javascript\"></script>";
    foreach ($arrCss as $strCss => $strType)
    {
        if ($strType == "css")
        {
            $strPageStart .= "
            <link type = \"text/css\" media = \"screen\" rel = \"stylesheet\" href = \"http://www.rimiclacihomecare.co.nf/css/" . $strCss . ".css\"/>";
        }
        if ($strType == "js")
        {
            $strPageStart .= "
            <script type = \"text/javascript\" src = \"http://www.rimiclacihomecare.co.nf/javascript/" . $strCss . ".js\"></script>";
        }
    }
    echo $strPageStart;
}

function build_main_menu($arrMainMenuItems, $strActiveMenu)
{
    //Header start
    $strHeader = "
        <!-- site navigation -->
        <div id='cssmenu'>
            <ul>";
    foreach ($arrMainMenuItems as  $arrMenuItems)
    {
        if($arrMenuItems["controller"] == $strActiveMenu)
        {
            $strHeader .= "
                <li class='active'><a href='/index.php/".$arrMenuItems["controller"]."'>".$arrMenuItems["name"]."</a></li>";
        }
        else
        {
            $strHeader .= "
                <li><a href='/index.php/".$arrMenuItems["controller"]."'>".$arrMenuItems["name"]."</a></li>";
        }
    }

    $strHeader .= build_logoff();

    $strHeader .= "
            </ul>
        </div>
        <!-- end of site navigation -->
         ";
    return $strHeader;
}

function build_logoff()
{
    return "
            <li>
                <form method=\"post\" action = \"/index.php/default/index\">
                    " . $_SESSION['useremail'] . "
                    <a href = \"/index.php/start\">Log uit.</a>
                </form>
            </li>
        </ul>";
}

function build_footer()
{
    return "
        <div id = \"footer\">
        </div>
        <!-- footer div -->
    </body>
</html>";
}

?>