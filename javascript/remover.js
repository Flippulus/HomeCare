function deleteItem(id)
{
    if(confirm("Weet u zeker dat u dit planningsitem wilt verwijderen?") == true)
    {
        window.location = "/index.php/planning?action=remove&id=" + id;
    }
}

function goToLink(link)
{
    window.location = link;
}