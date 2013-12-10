function showHide(id)
{
if (document.getElementById(id))
    {
        if (document.getElementById(id).style.display === 'none')
        {
            var elements = document.getElementsByClassName("userdata" + id);
            for (var i in elements)
            {
                if (elements.hasOwnProperty(i))
                {elements[i].style.display = 'block';}
            }
        }
        else
        {
            var elements = document.getElementsByClassName("userdata" + id);
            for (var i in elements)
            {
                if (elements.hasOwnProperty(i))
                {elements[i].style.display = 'none';}
            }
        }
    }
}