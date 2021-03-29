<?php
session_start();

if (!$_SESSION['loggedin']) {
	header("Location: login.php");
}
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
				<li id="current" class="col-4 col-t-6"><a href="userpage.php">Profil adatok</a></li>
				<li class="col-4 col-t-6"><a href="transaction.php">Utalás</a></li>		
				<li class="col-4 col-t-6"><a href="logout.php">Kijelentkezés</a></li>		
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
	<h3>
		<?php
		echo htmlspecialchars("Üdvözöljük " . $_SESSION['username'] . "!", ENT_QUOTES, "UTF-8", TRUE);
		
		require_once("connect.php");
		$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, "UTF-8", TRUE);
		$query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
		$row = mysqli_fetch_assoc($query);
		?>
	</h3>
	<table>
		<tr>
			<td><b>Felhasználónév:</b></td>
			<td><?php echo htmlspecialchars($row['username'], ENT_QUOTES, "UTF-8", TRUE); ?></td>
		</tr>
		<tr>
			<td><b>E-mail cím:</b></td>
			<td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, "UTF-8", TRUE); ?></td>
		</tr>
		<tr>
			<td><b>Számlaszám:</b></td>
			<td><?php echo htmlspecialchars($row['bankaccount_nbr_from'], ENT_QUOTES, "UTF-8", TRUE); ?></td>
		</tr>
	</table>
</article>
</div>

<div class="row">
<footer>Ez egy fiktív neobank felületet bemutató weboldal.<br>Móczó Árpád weboldala</footer>
</div>

</body>
</html>
