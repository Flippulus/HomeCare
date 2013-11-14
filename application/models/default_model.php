<?php


class Default_Model extends TinyMVC_Model
{
    function getPageData()
    {
        $strContents = "
            <script type=\"text/javascript\">
            $(document).ready(function() {
            $(\".username\").focus(function() {
                    $(\".user-icon\").css(\"left\",\"-48px\");
            });
            $(\".username\").blur(function() {
                    $(\".user-icon\").css(\"left\",\"0px\");
            });
            
            $(\".password\").focus(function() {
                    $(\".pass-icon\").css(\"left\",\"-48px\");
            });
            $(\".password\").blur(function() {
                    $(\".pass-icon\").css(\"left\",\"0px\");
            });
            });
            </script>
            </head>
            <body>
            
                <div id=\"wrapper\">
                    <div class=\"user-icon\"></div>
                    <div class=\"pass-icon\"></div>
                        
                    <form name=\"login-form\" class=\"login-form\" action=\"\" method=\"post\">
                        <div class=\"header\">
                            <h1>Login</h1>
                            <span>Vul emailadres en wachtwoord in.</span>
                        </div>
                        <div class=\"content\">
                            <input name=\"login_mail\" type=\"text\" class=\"input username\" placeholder = \"Email\" />
                            <input name=\"login_pass\" type=\"password\" class=\"input password\" placeholder = \"Paswoord\" />
                        </div>
                        <div class=\"footer\">
                            <input type=\"submit\" name=\"frmLogOn\" value=\"Login\" class=\"button\" />
                        </div>
                    </form>

                </div>
                <div class=\"gradient\"></div>
                ".  build_footer();
        return $strContents;
    }
    
}

?>