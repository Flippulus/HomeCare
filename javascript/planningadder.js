var id = 0;

function addItem()
{
    var inputId = "#planning_" + id;
    id++;
    var nextId = "planning_" + id;
    
    var tekst = "\n\
            <tr id = \"" + nextId + "\">\n\
            <td><input type = \"time\" name = \"planning_time_" + id + "\" step = 900></td>\n\
            <td>\n\
                <select name = \"planning_client_" + id + "\">\n\
                    <option value = \"na\">Kies...</option>";
        
        for(var i = 0; i < arrClients.length; i++)
        {
            tekst += "\n\
                    <option value = \"" + arrClients[i][0] + "\">" + arrClients[i][1] + " " + arrClients[i][2] + "</option>";
        }
        
        tekst += "\
            </select>\n\
            </td>\n\
            </tr>";
    
    $(inputId).after(tekst);
}