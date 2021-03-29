<?php 
session_start();

header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="author" content="Móczó Árpád">
	<meta name="description" content="Az oldal egy fiktív neobank felületet mutat be.">
	<link rel="icon" href="img/favicon.jpg" type="image/x-icon">
	<title>MoneyTrans - teszt weboldal</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
	<link rel="stylesheet" href="style.css">
</head>
<script>
<!--Sérülékeny, elavult kód alkalmazása-->
	function imgError() {
		var imgErrorMsg = "A kép nem jeleníthető meg";
		
		document.getElementById('imgError').innerHTML = errormsg;
	}
</script>
<body onload="">
	<div class="row">
		<header>
			<div id="fejlec">
				<div id="focim"><a href="index.php"><p>MoneyTrans</p><h3>Fiktív neobank</h3></a></div>		
			</div>
		</header>
		
		<div class="menu-container">
			<nav class="col-8 col-t-12">
				<ul id="menulist">
					<li id="current" class="col-3 col-t-6"><a href="index.php">Főoldal</a></li>
					<li class="col-3 col-t-6"><a href="aboutus.php">Rólunk</a></li>
					<li class="col-3 col-t-6"><a href="login.php">Bejelentkezés</a></li>		
					<li class="col-3 col-t-6"><a href="register.php">Fiók létrehozása</a></li>		
				</ul>
			</nav>
		</div>	 
	</div>

	<div class="row">
	<div class="col-2 col-t-12"> 
		
		<p style="color: white"><b>Válasszon nyelvet!</b></p>
		<!--A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).-->
		<form name="language-picker" method="GET">
			<select name="default">
				<script>
					if (document.location.href.indexOf("default=") >= 0) {
						var lang = document.location.href.substring(document.location.href.indexOf("default=")+8);
						
						document.write("<option value='" + lang + "'>" + decodeURI(lang) + "</option>");
						document.write("<option value='' disabled='disabled'>----</option>");
					}
					    
					document.write("<option value='Magyar'>Magyar</option>");
					document.write("<option value='Angol'>Angol</option>");
					document.write("<option value='Német'>Német</option>");					
					document.write("<option value='Francia'>Francia</option>");
					document.write("<option value='Spanyol'>Spanyol</option>");
				</script>
			</select>
			<input type="submit" value="Kiválaszt" />
		</form>
	</div>

	<article class="col-8 col-t-12">
		<h3 id="valalkozas">A MoneyTrans világvezető neobank</h3>
		<p class="col-7 col-t-6">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dignissim ornare tortor, nec ultricies orci ornare consequat. Mauris congue erat eget mauris faucibus rhoncus. Pellentesque mattis enim tortor. Donec rhoncus semper est, sed sagittis ligula tempor eu. Aliquam ullamcorper rhoncus odio a blandit. Morbi at arcu id purus tempus pretium. Morbi a nisl commodo, accumsan ex ut, sodales enim. Nam velit sapien, bibendum eget lobortis et, accumsan sed nulla. Sed dui libero, varius in velit sed, dignissim mollis nunc.
		</p>
		<figure class="col-5 col-t-6">
			<img src="img/fooldal1.jpg" onerror="imgError()" width="600">
			<figcaption id="errorMsg"></figcaption>
		</figure>
		
		<p class="col-12 col-t-12">
			Curabitur malesuada sit amet augue id interdum. Vivamus vestibulum vestibulum justo efficitur mollis. Mauris ultrices, nisl sed eleifend pulvinar, nulla mi vulputate arcu, vitae fermentum eros mi at felis. Morbi vestibulum sem in nulla eleifend, non elementum nulla feugiat. Nam eget iaculis magna, in aliquet nibh. Aliquam ut blandit quam. Integer in ipsum eu libero scelerisque dictum. Quisque euismod libero metus.
		</p>

		
		<h3 id="missvis">Legyen ügyfelünk!</h3>
		<p class="col-7 col-t-6">
			Praesent et quam auctor, porttitor nulla ac, rhoncus tellus. Aenean gravida eget neque et maximus. Nam hendrerit pellentesque nisi, eu consectetur arcu ultrices non. Maecenas eleifend pulvinar sem, eget vehicula leo rhoncus vel. Ut dictum dictum libero eget sodales. Phasellus pulvinar magna non luctus lacinia. Aliquam accumsan est in dolor vestibulum, vel interdum sem eleifend. Vestibulum lobortis massa mi, vitae tempus diam tincidunt ut. Praesent laoreet nulla massa, a finibus ante scelerisque nec. Aliquam ac condimentum nunc. Donec consectetur nunc lorem, ac mattis metus maximus sit amet. Praesent hendrerit purus ligula, a tristique ante consectetur vitae.
		</p>		
		<figure class="col-5 col-t-6">
			<img src="img/fooldal2.jpg" onerror="imgError()" width="600">
			<figcaption id="errorMsg"></figcaption>
		</figure>
		
		<p class="col-12 col-t-12">
			Suspendisse venenatis ipsum fermentum eros porta, sed ultricies arcu facilisis. Quisque a vehicula augue. Phasellus in fringilla nisl. Curabitur sed hendrerit nibh. Aliquam eget vehicula nibh. Proin in nunc eu nisi consequat venenatis. Aliquam ac augue ac ipsum commodo molestie. Morbi vehicula pulvinar lectus, id varius sapien porta id.
		</p>
		
		<h3 id="csapat">Megbízható szolgáltatást nyújtunk</h3>
		<p  class="col-12 col-t-12">
			Aenean eget erat non ipsum tincidunt fringilla vitae in mi. Integer vel ornare tortor. Aenean scelerisque erat nec velit sollicitudin, vel mattis neque faucibus. Mauris consectetur odio nec hendrerit elementum. Etiam mattis, nisl sed consequat semper, urna nisl mattis odio, a vulputate nulla nunc vitae diam. Pellentesque id porttitor tortor. Curabitur ac metus imperdiet elit iaculis ultrices. Nunc sed blandit magna.
		</p> 
	</article>
	</div>

	<div class="row">
	<footer>Ez egy fiktív neobank felületet bemutató weboldal.<br>Móczó Árpád weboldala</footer>
	</div>
</body>
<script>
</html>
