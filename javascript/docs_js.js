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
    document.getElementById("selectedmap").value = object.id.replace(/map_/g, "");
}

function selectdoc(object)
{
    document.getElementById("selecteddoc").value = object.id.replace(/doc_/g, "");
    for(var i = 0; i < arrDocs.length; i++)
    {
        var docId = "doc_" + arrDocs[i][0];
        if(object.id == docId)
        {
            var tekst = "<p>Geselecteerd bestand:</p>\n\
                             <p>Naam: " + arrDocs[i][1] + "</p>";
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
            tekst +=        "<p>Type: " + type + "</p>\n\
                             <p>Bestand downloaden:</p>\n\
                             <a href = \"/documents/general/" + arrDocs[i][3] + "/" + arrDocs[i][1] + "." + arrDocs[i][2] + "\">\n\
                                 " + arrDocs[i][1] + "." + arrDocs[i][2] + "\n\
                             </a>";
            document.getElementById("file_info").innerHTML = tekst;
            document.getElementById("file_info").style.padding = "10px";
        }
    }
}