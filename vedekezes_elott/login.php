<?php
ob_start();
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
    function blankcheck() {
        var errormsg = "<b><span style='color:red'>A bejelentkezéshez a felhasználónevet és a jelszót is meg kell adni!</span></b>";

        if (document.getElementById('username').value == "" ||
            document.getElementById('password').value == "") {
            document.getElementById('errors_log').innerHTML = errormsg;
            return false;
        } else {
            return true;
        }
    }
</script>



<body>

<div class="row">
	<header>
		<div id="fejlec">
			<div id="focim"><a href="index.php"><p>MoneyTrans</p><h3>Fiktív neobank</h3></a></div>		
		</div>
	</header>
	
	<div class="menu-container">
		<nav class="col-8 col-t-12">
			<ul id="menulist">
				<li class="col-3 col-t-6"><a href="index.php">Főoldal</a></li>
				<li class="col-3 col-t-6"><a href="aboutus.php">Rólunk</a></li>
				<li id="current" class="col-3 col-t-6"><a href="login.php">Bejelentkezés</a></li>		
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
	<h3 id="valalkozas">Kérem adja meg bejelentkezési adatait</h3>
	<div id="errors_log">
        <?php
        if (isset($_GET["nomatch"])) {
            if ($_GET["nomatch"] == true) {
                echo "<b><span style='color:red'>Hibás felhasználó név/jelszó páros</span></b>";
            }
        }
		if (isset($_SESSION['reg'])) {
			echo $_SESSION['reg'];
			unset($_SESSION['reg']);
		}
		if (isset($_SESSION['reg_error'])) {
			echo $_SESSION['reg_error'];
			unset($_SESSION['reg_error']);
		}
        ?>
    </div>
	
    <form action="check_log.php" onSubmit="return blankcheck()" method="post" id="login_form">
		<table>
			<tr>
				<td>Felhasználó név:</td>
				<td><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td>Jelszó:</td>
				<td><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Bejelentkezés"></td>
			</tr>
		</table>
    </form>
</article>
</div>

<div class="row">
<footer>Ez egy fiktív neobank felületet bemutató weboldal.<br>Móczó Árpád weboldala</footer>
</div>

</body>
</html>
