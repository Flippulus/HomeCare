function selectmap(object)
{
    var arrMaps = document.getElementsByClassName("map");
    for(var i = 0; i < arrMaps.length; i++)
    {
        if(arrMaps[i].nodeName.toLowerCase() === "li")
        {
            if(arrMaps[i].id === object.id)
            {
                object.style.color = "#ff4c4c";
                var arrDocs = document.getElementsByClassName("docs");
                for(var i2 = 0; i2 < arrDocs.length; i2++)
                {
                    if(arrDocs[i2].id === object.id)
                    {
                        if(arrDocs[i2].style.display === "block")
                        {arrDocs[i2].style.display = "none";}
                        else
                        {arrDocs[i2].style.display = "block";}
                    }
                }
            }
            else
            {
                arrMaps[i].style.color= "#EEEEEE";
            }
        }
    }
    var mapName = object.id.replace(/map_/g, "");
    if(document.getElementById("selectedmap").value === mapName)
    {
        document.getElementById("selectedmap").value = "root";
        object.style.color = "#EEEEEE";
        document.getElementById("map_info").innerHTML = "";
    }
    else
    {
        var code = "<p>" + mapName + "</p>\n\
                    <a href = \"/index.php/documenten?action=removemap&id=" + object.id.replace(/map_/g, "") + "\">map verwijderen</a>";
        document.getElementById("selectedmap").value = mapName;
        document.getElementById("map_info").innerHTML = code;
    }
}

function selectdoc(object)
{
    document.getElementById("selecteddoc").value = object.id.replace(/doc_/g, "");
    for(var i = 0; i < arrDocs.length; i++)
    {
        var docId = "doc_" + arrDocs[i][0];
        if(object.id == docId)
        {
            var tekst = "<p>Naam: " + arrDocs[i][1] + "</p>";
            switch(arrDocs[i][2])
            {
                case "txt":
                    var type = "tekstbestand";
                    break;
                case "docx":
                    var type = "word-bestand";
                    break;
                case "doc":
                    var type = "word-bestand";
                    break;
                case "xls":
                    var type = "excel-bestand";
                    break;
                case "xlsx":
                    var type = "excel-bestand";
                    break;
                case "ppt":
                    var type = "powerpoint-bestand";
                    break;
                case "pps":
                    var type = "powerpoint-bestand";
                    break;
                case "pptx":
                    var type = "powerpoint-bestand";
                    break;
                case "ppsx":
                    var type = "powerpoint-bestand";
                    break;
                case "pdf":
                    var type = "pdf-bestand";
                    break;
                case "png":
                    var type = "afbeelding";
                    break;
                case "jpeg":
                    var type = "afbeelding";
                    break;
                case "jpg":
                    var type = "afbeelding";
                    break;
                case "gif":
                    var type = "afbeelding";
                    break;
                case "bmp":
                    var type = "afbeelding";
                    break;
                default:
                    var type = "geen type gedefinieerd";
                    break;
            }
            var id = document.getElementById("selecteddoc").value;
            tekst +=        "<p>Type: " + type + "</p>\n\
                             <a href = \"/documents/general/" + arrDocs[i][3] + "/" + arrDocs[i][1] + "." + arrDocs[i][2] + "\" target = \"_blank\">\n\
                                 Bestand downloaden\n\
                             </a>\n\
                             <br>\n\
                             <br>\n\
                             <a href = '/index.php/documenten?action=delete&id=" + id + "'>Bestand verwijderen</a>";
            document.getElementById("file_info").innerHTML = tekst;
        }
    }
}

function selectclientdoc(object)
{
    document.getElementById("selecteddoc").value = object.id.replace(/doc_/g, "");
    for(var i = 0; i < arrDocs.length; i++)
    {
        var docId = "doc_" + arrDocs[i][0];
        if(object.id == docId)
        {
            var tekst = "<p>Naam: " + arrDocs[i][1] + "</p>";
            switch(arrDocs[i][2])
            {
                case "txt":
                    var type = "tekstbestand";
                    break;
                case "docx":
                    var type = "word-bestand";
                    break;
                case "doc":
                    var type = "word-bestand";
                    break;
                case "xls":
                    var type = "excel-bestand";
                    break;
                case "xlsx":
                    var type = "excel-bestand";
                    break;
                case "ppt":
                    var type = "powerpoint-bestand";
                    break;
                case "pps":
                    var type = "powerpoint-bestand";
                    break;
                case "pptx":
                    var type = "powerpoint-bestand";
                    break;
                case "ppsx":
                    var type = "powerpoint-bestand";
                    break;
                case "pdf":
                    var type = "pdf-bestand";
                    break;
                case "png":
                    var type = "afbeelding";
                    break;
                case "jpeg":
                    var type = "afbeelding";
                    break;
                case "jpg":
                    var type = "afbeelding";
                    break;
                case "gif":
                    var type = "afbeelding";
                    break;
                case "bmp":
                    var type = "afbeelding";
                    break;
                default:
                    var type = "geen type gedefinieerd";
                    break;
            }
            var id = document.getElementById("selecteddoc").value;
            tekst +=        "<p>Type: " + type + "</p>\n\
                             <a href = \"/documents/clients/" + arrDocs[i][3] + "/" + arrDocs[i][1] + "." + arrDocs[i][2] + "\" target = \"_blank\">\n\
                                 Bestand downloaden\n\
                             </a>\n\
                             <br>\n\
                             <br>\n\
                             <a href = '/index.php/clienten?action=delete&id=" + id + "'>Bestand verwijderen</a>";
            document.getElementById("file_info").innerHTML = tekst;
        }
    }
}