function showHide(klasse, id)
{
if (document.getElementById(id))
    {
        if (document.getElementById(id).style.display === 'none')
        {
            var elements = document.getElementsByClassName(klasse + id);
            for (var i in elements)
            {
                if (elements.hasOwnProperty(i))
                {elements[i].style.display = 'table-row';}
            }
        }
        else
        {
            var elements = document.getElementsByClassName(klasse + id);
            for (var i in elements)
            {
                if (elements.hasOwnProperty(i))
                {
                    elements[i].style.display = 'none';
                    
                }
            }
        }
    }
}