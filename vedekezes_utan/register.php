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
    function blankcheck() {
        var errormsg = "A regisztrációhoz a felhasználónevet, az e-mail címet és a jelszót is meg kell adni!";
		var errormsg_mail = "Az e-mail cím nem megfelelő formátumú!";
		var errormsg_password = "A jelszónak legalább 8 karakterből kell állnia, tartalmaznia kell legalább 1 kis- és nagybetűt, 1 számot és 1 speciális karaktert!";

        if (document.getElementById('username_reg').value == "" ||
            document.getElementById('email_reg').value == "" ||
			document.getElementById('password_reg').value =="" ||
			document.getElementById('password2_reg').value ==""){
            document.getElementById('errors_reg').innerText = errormsg;
            return false;
        } else {
			//Az e-mail ellenőrző forrása: https://www.w3resource.com/javascript/form/email-validation.php
			if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(register_form.email_reg.value))
			{
				//Az jelszó ellenőrző forrása: https://gist.github.com/HarishChaudhari/0dd5514ce430991a1b1b8fa04e8b72a4
				if (/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/.test(register_form.password_reg.value)) {
					return true;
				} else {
					document.getElementById('errors_reg').innerText = errormsg_password;
					return false;
				}
			} else {
				document.getElementById('errors_reg').innerText = errormsg_mail;
				return false;
			
			}
		}
	}
</script>

<?php
//A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).
// Létezik input érték?
	if ( array_key_exists( "default", $_GET ) && !is_null ($_GET['default']) ) {

		# Engedélyezett nyelvek listája
		switch ($_GET['default']) {
			case "Magyar":
			case "Angol":
			case "Német":
			case "Francia":
			case "Spanyol":
				# OK
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
				<li class="col-3 col-t-6"><a href="login.php">Bejelentkezés</a></li>		
				<li id="current" class="col-3 col-t-6"><a href="register.php">Fiók létrehozása</a></li>		
			</ul>
		</nav>
	</div>	 
</div>

<div class="row">
<div class="col-2 col-t-12"> 
	<p id="language"><b>Válasszon nyelvet!</b></p>
	
	<!--A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).-->	
	<form name="language-picker" method="GET">
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
	<h3 id="valalkozas">Hozzon létre fiókot a MoneyTrans neobanknál most!</h3>
	<div id="errors_reg">
		<?php
			if (isset($_SESSION['reg_error'])) {
				echo $_SESSION['reg_error'];
				unset($_SESSION['reg_error']);
			}
			if (isset($_SESSION['errors']['email'])) {
				echo htmlspecialchars($_SESSION['errors']['email'], ENT_QUOTES, "UTF-8", TRUE);
				unset($_SESSION['errors']['email']);
			}
			if (isset($_SESSION['errors']['password'])) {
				echo htmlspecialchars($_SESSION['errors']['password'], ENT_QUOTES, "UTF-8", TRUE);
				unset($_SESSION['errors']['password']);
			}
			if (isset($_SESSION['errors']['password2'])) {
				echo htmlspecialchars($_SESSION['errors']['password2'], ENT_QUOTES, "UTF-8", TRUE);
				unset($_SESSION['errors']['password2']);
			}
			if (isset($_SESSION['csrf_error'])) {
				echo htmlspecialchars($_SESSION['csrf_error'], ENT_QUOTES, "UTF-8", TRUE);
				unset($_SESSION['csrf_error']);
			}
		?>
	</div>
	
    <form action="check_reg.php" onSubmit="return blankcheck()" method="post" id="register_form">
		<table>
			<tr>
				<td>Felhasználónév:</td>
				<td><input type="text" name="username_reg" id="username_reg"></td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><input type="text" name="email_reg" id="email_reg"></td>
			</tr>
			<tr>
				<td>Jelszó:</td>
				<td><input type="password" name="password_reg" id="password_reg"></td>
			</tr>
			<tr>
				<td>Jelszó megerősítse:</td>
				<td><input type="password" name="password2_reg" id="password2_reg"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="anti_csrf" value="<?php echo $_SESSION['token'] ?>"></td>
				<td><input type="submit" name="register" value="Regisztráció"></td>
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

