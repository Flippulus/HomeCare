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
        <link rel=\"shortcut icon\" type=\"image/png\" href=\"/images/default/faviconHomeCare.png\">
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
    foreach ($arrMainMenuItems as $arrMenuItems)
    {
        if ($arrMenuItems["controller"] == $strActiveMenu)
        {
            $strHeader .= "
                <li class='active'><a href='/index.php/" . $arrMenuItems["controller"] . "'>" . $arrMenuItems["name"] . "</a></li>";
        }
        else
        {
            $strHeader .= "
                <li><a href='/index.php/" . $arrMenuItems["controller"] . "'>" . $arrMenuItems["name"] . "</a></li>";
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

function buildSubMenu($arrMenuItems, $strActiveMenu)
{
    $strMenu = "
        <!-- submenu -->
        <table id = \"submenu\">";

    foreach ($arrMenuItems as $strMenuItem => $arrMenuItem)
    {
        if ($strActiveMenu == $strMenuItem)
        {
            $strMenu .= "
            <tr>
                <td class = \"active\" onclick = \"window.location = '/index.php/" . $arrMenuItem["controller"] . "'\">" . $arrMenuItem["name"] . "</td>
            </tr>";
        }
        else
        {
            $strMenu .= "
            <tr>
                <td onclick = \"window.location = '/index.php/" . $arrMenuItem["controller"] . "'\">" . $arrMenuItem["name"] . "</td>
            </tr>";
        }
    }

    $strMenu .= "
        </table>
        <!-- End of submenu -->";

    return $strMenu;
}

function build_logoff()
{
    return "
        <ul id = \"logoff\">
            <li>
                <a href = \"/index.php/start\">
                    " . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "
                    Log uit
                </a>
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