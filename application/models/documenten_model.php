<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Class Documenten_Model extends CI_Model
{
    function getPageData($arrMainMenuItems, $blnLoggedOn)
    {
        $strContents = "
            </head>
            <body style =\"text-align:center\">";;

            $strContents.=build_main_menu($arrMainMenuItems, $blnLoggedOn);
            
            if (!isset($_POST["frmDocument"])){
                
                $strContents.= "
<h2>Document uploaden</h2>
<form method=\"post\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"frmDocument\" value=\"true\">
<table border=\"1\">

<tr>
    <td>Naam document</td>
    <td><input type=\"text\" name=\"naam\" size=\"20\"></td>
</tr>
<tr>
    <td>Document</td>
    <td><input type=\"file\" name=\"doc\"></td>
</tr>
<tr>
    <td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Upload\"></td>
</tr>
</table>
</form>  ";
                
            }
            
            else
            {
                echo "gelukt";
    /*
    //process the  form
    $docName = $_FILES['doc']['tmp_name'];
    $docSize = $_FILES['doc']['size'];
    $docType = $_FILES['doc']['type'];
    $docError = $_FILES['doc']['error'];
 
     allowedExts = array("pdf", "doc", "docx"); 
     $extension = end(explode(".", $_FILES["file"]["name"]));
      
    $docName=$_POST['naam']. '_Resume.txt';
    if ($fileError)
    {
        echo "We could not upload the file:<br>$fileError";
        endPage();
    }
    elseif ($fileType != 'text/plain')
    {
        echo "You have attempted to upload a file of type: $fileType.
                <br>Only text files allowed.";
        endPage();
    }
 
    $fileSavePath = 'Documenten/' . $resumeName;   
    if (is_uploaded_file($resumeFile))
    {
        if (!move_uploaded_file($resumeFile,$fileSavePath))
        {
            echo 'Could not save file.';
            endPage();
        }
    }
    else
    {
        //This case happens if somehow the file
        //we are working with was already on the server.
        //It's to stop hackers.
        echo 'Hey, what is going on here?
                    Are you being bad?';
        endPage();
    }
    $resume=makeFileSafe($fileSavePath);
                */
            }
            
        
        $strContents .= build_footer();
        return $strContents;
    }
    
    
    
    
    
    
}
?>
