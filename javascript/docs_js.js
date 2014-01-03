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
    document.getElementById("selectedmap").value = object.id;
}

function selectdoc(object)
{
    document.getElementById("selecteddoc").value = object.id;
}