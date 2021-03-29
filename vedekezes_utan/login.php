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
        var errormsg = "A bejelentkezéshez a felhasználónevet és a jelszót is meg kell adni!";

        if (document.getElementById('username').value == "" ||
            document.getElementById('password').value == "") {
            document.getElementById('errors_log').innerText = errormsg;
            return false;
        } else {
            return true;
        }
    }
</script>

<?php
//A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).
	// Létezik input érték?
	if ( array_key_exists( "default", $_GET ) && !is_null ($_GET['default']) ) {

		//Engedélyezett nyelvek listája
		switch ($_GET['default']) {
			case "Magyar":
			case "Angol":
			case "Német":
			case "Francia":
			case "Spanyol":
				//OK
				break;
			default:
				header ("location: ?default=Magyar");
				exit;
		}
	}
	
//Anti-CSRF token
	//kulcs generálása
	$_SESSION['key'] = bin2hex(random_bytes(32));
	
	//Anti-CSRF token létrehozása a kulcs felhasználásával
	$_SESSION['token'] = hash_hmac("sha256", "rtzjnxcvysdgfbnhgfhgaseqwkokmxgbwerthufgsasdfbuztflkmnvxyq", $_SESSION['key']);
?>

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
	<p id="language"><b>Válasszon nyelvet!</b></p>
	
	<!--A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).-->	
	<form name="language-picker" method="GET" onSubmit="">
		<select name="default">
			<script>
				if (document.location.href.indexOf("default=") >= 0) {
					var lang = document.location.href.substring(document.location.href.indexOf("default=")+8);
						
					document.write("<option value='" + lang + "'>" + encodeURI(lang) + "</option>");
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
                echo "Hibás felhasználó név/jelszó páros!";
            }
        }
		if (isset($_SESSION['reg'])) {
			echo $_SESSION['reg'];
			unset($_SESSION['reg']);
		}
		if (isset($_SESSION['csrf_error'])) {
			echo $_SESSION['csrf_error'];
			unset($_SESSION['csrf_error']);
		}
        ?>
    </div>
	
    <form action="check_log.php" onSubmit="return blankcheck()" method="post" id="login_form">
		<table>
			<tr>
				<td>Felhasználónév:</td>
				<td><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td>Jelszó:</td>
				<td><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="anti_csrf" value="<?php echo $_SESSION['token'] ?>"></td>
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
