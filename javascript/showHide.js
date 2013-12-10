function showHide(id, here)
{
   if (document.getElementById(id))
   {
      if (document.getElementById(id).style.display === 'none')
      {
          document.getElementById(id).style.display = 'block';
          here.innerHTML = "<td>Klik hier om terug in te klappen.</td>";
      }
      else
      {
          document.getElementById(id).style.display = 'none';
          here.innerHTML = "<td>Klik hier voor meer info.</td>";
      }
   }
}


