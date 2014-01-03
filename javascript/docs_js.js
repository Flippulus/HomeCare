function selectmap(object)
{
    var arrChildren = document.getElementsByClassName("maps")[0].childNodes;
    for(var i = 0; i < arrChildren.length; i++)
    {
        if(arrChildren[i].nodeName.toLowerCase() === "li")
        {
            if(arrChildren[i].id === object.id)
            {
                object.style.color = "red";
                var arrMaps = document.getElementsByClassName("docs");
                for(var i2 = 0; i2 < arrMaps.length; i2++)
                {
                    if(arrMaps[i2].id == object.id)
                    {
                        if(arrMaps[i2].style.display == "block")
                        {arrMaps[i2].style.display = "none";}
                        else
                        {arrMaps[i2].style.display = "block";}
                    }
                }
            }
            else
            {
                arrChildren[i].style.color= "#EEEEEE";
            }
        }
    }
    
}

function selectdoc(object)
{
    
}