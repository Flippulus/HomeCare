<?php

/*
 * 
 * PHP version 5
 * 
 * @Package accountanting
 * @Author Philippe Dirx <philippedirx@hotmail.com>
 * @Copyright 2013
 * @License
 * 
 * 
 * This file is property of Philippe Dirx.
 * This file is not meant to be used by others then Philippe Dirx or his assigners.
 * This file is created for the sole purpose of supporting the company of ThreeS, property of Rudi op 't Roodt, Boy Smeets and Roné Kirkels
 * 
 * 
 * Using tinyMVC structure: Model <- Controller -> View
 * 
 * script, autoloaded in sysfiles/configs/autoload.php
 * functions are public, can be hailed from any controller, model or view in myapp
 * 
 */

class HtmlHelpers
{
    
    public function __construct()
    {}
    public function __destruct()
    {}

    public function createPageStart($strTitle, $arrCss)
    {
        $strPageStart = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/strict.dtd\">
<html>
    <head>
        <title>" . $strTitle . "</title>
        <meta http-equiv = \"content-type\" content=\"text/html;charset = utf-8\" />
        <link type = \"text/css\" media = \"screen\" rel = \"stylesheet\" href = \"/css/default.css\"/>
        <link rel=\"shortcut icon\" type=\"image/png\" href=\"/images/faviconHomeCare.png\">
        <script src = \"/javascript/jQuery.js\" type = \"text/javascript\"></script>";
        foreach ($arrCss as $strCss => $strType)
        {
            if ($strType == "css")
            {
                $strPageStart .= "
            <link type = \"text/css\" media = \"screen\" rel = \"stylesheet\" href = \"/css/" . $strCss . ".css\"/>";
            }
            if ($strType == "js")
            {
                $strPageStart .= "
            <script type = \"text/javascript\" src = \"/javascript/" . $strCss . ".js\"></script>";
            }
        }

        echo $strPageStart;
    }

    public function build_main_menu($arrMainMenuItems, $blnLoggedOn)
    {
        //Header start
        $strHeader = "
        <!-- site navigation -->
        <div class = \"mainmenuwrapper\">
            <div class = \"mainmenucontainter\">
                <ul class = \"mainmenu\">";
        foreach ($arrMainMenuItems as $arrSubMenuItems)
        {
            $strHeader .= "
                    <li title = \"Ga naar de " . $arrSubMenuItems["name"] . " pagina\">
                        <a href = \"/index.php/" . $arrSubMenuItems["controller"] .
                    "/index\">" . $arrSubMenuItems["name"] . "</a>
                    </li>";
        }

        if ($blnLoggedOn == true)
        {
            $strHeader .= build_logoff();
        }
        else
        {
            $strHeader .= build_login();
        }

        $strHeader .= "
                </ul>
            </div><!-- mainmenucontainer -->
         </div><!-- mainmenuwrapper -->
         <!-- end of site navigation -->
         ";
        return $strHeader;
    }

    function build_login()
    {

        $strText = "
            </ul>
            <ul class = \"login\">
                <li>";

        $strText .= "
                    <form method=\"post\">
                        email: <input type=\"email\" name=\"login_mail\" />
                        Password: <input type=\"password\" name=\"login_pass\" />
                        <input type=\"submit\" name = \"frmLogOn\" value=\"Login\" />
                    </form>
                </li>
            </ul>";

        return $strText;
    }

    public function build_logoff()
    {
        return "
        </ul>
        <ul class = \"login\">
            <li>
                <form method=\"post\" action = \"/index.php/default/index\">
                    <label>Ingelogd als " . $_SESSION['useremail'] . "</label>
                    <input type=\"submit\" name = \"frmLogOff\" value=\"Log uit\" />
                </form>
            </li>
        </ul>";
    }

    public function build_footer()
    {
        return "
        <div id = \"footer\">
        </div>
        <!-- footer div -->
    </body>
</html>";
    }

}

?>