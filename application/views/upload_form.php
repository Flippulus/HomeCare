
<html>
<head>
<title>Upload Form</title>
</head>
<body>


        <form action="" method="POST" enctype="multipart/form-data" >
            Select File To Upload:<br />
            <input type="file" name="userfile" multiple="multiple"  />
            
            <input type="submit" name="submit" value="Upload" class="btn btn-success" />
        </form>
 
        <?php {if isset($uploaded_file)}
            {foreach from=$uploaded_file key=name item=value}
                {$name} : {$value}
                <br />
            {/foreach}    
        {/if} ?>
</body>
</html>