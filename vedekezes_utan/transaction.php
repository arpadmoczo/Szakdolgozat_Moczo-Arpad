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

<script>
    function blankcheck() {
        var errormsg = "A tranzakció elindításához az összeget, kezdeményezett bankszámlszámot és a közleményt is meg kell adni!";
		
        if (document.getElementById('sum').value == "" ||
            document.getElementById('statement').value == "" ||
			document.getElementById('nbr_1').value == "" ||
			document.getElementById('nbr_2').value == "" ||
			document.getElementById('nbr_3').value == "") {
			document.getElementById('errors_trans').innerText = errormsg;
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
				<li class="col-4 col-t-6"><a href="userpage.php">Profil adatok</a></li>
				<li id="current" class="col-4 col-t-6"><a href="transaction.php">Utalás</a></li>		
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
	<h1>
		Tranzakció indítása, korábbi tranzakciók megtekintése
	</h1><hr>
	
	<?php
		require_once("connect.php");
		$username =  htmlspecialchars($_SESSION['username'], ENT_QUOTES, "UTF-8", TRUE);
		
		$query_user = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
		$row_user = mysqli_fetch_assoc($query_user);
	?>
	
	<div id="errors_trans">
	<?php
		if (isset($_SESSION['trans'])) {
			echo $_SESSION['trans'];
			unset($_SESSION['trans']);
		}
		if (isset($_SESSION['trans_error'])) {
			echo $_SESSION['trans_error'];
			unset($_SESSION['trans_error']);
		}
		if (isset($_SESSION['csrf_error'])) {
			echo $_SESSION['csrf_error'];
			unset($_SESSION['csrf_error']);
		}
	?>
	</div>
	
	<form action="utalasok.php" onSubmit="return blankcheck()" method="post">
		<table>
			<tr>
				<td>Kezdeményező bankszámlaszáma:</td>
				<td><b><?php echo htmlspecialchars($row_user['bankaccount_nbr_from'], ENT_QUOTES, "UTF-8", TRUE);?></b></td>
			</tr>
			<tr>
				<td>Kezdeményezett bankszámlaszáma</td>
				<td>
					<input type="number" min="100" max="999" name="nbr_1" id="nbr_1">-
					<input type="number" min="100" max="999" name="nbr_2" id="nbr_2">-
					<input type="number" min="100" max="999" name="nbr_3" id="nbr_3">
				</td>
			</tr>
			<tr>
				<td>Utalás összege:</td>
				<td><input type="text" name="sum" id="sum"></td>
			</tr>
			<tr>
				<td>Közlemény:</td>
				<td><input type="text" name="statement" id="statement"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="anti_csrf" value="<?php echo $_SESSION['token'] ?>"></td>
				<td><input type="submit" name="transaction" value="Küldés"></td>
			</tr>
		</table><br>
		
		<hr><h3>Elküldött utalásaim:</h3><hr>
		<table class="col-12 col-t-12">
			<tr>
				<td class="col-1 col-t-1"><b>Azonosító</b></td>
				<td class="col-3 col-t-3"><b>Utalás összege</b></td>
				<td class="col-3 col-t-3"><b>Kezdeményezett számlaszám</b></td>
				<td class="col-3 col-t-3"><b>Közlemény</b></td>
				<td class="col-2 col-t-2"><b>Dátum</b></td>
			</tr>
		
		<?php
			$query_trans = mysqli_query($connection, "SELECT * FROM utalasok WHERE username = '$username'");
		
			while ($row_trans = mysqli_fetch_assoc($query_trans)) {
		?>

				<tr>
					<td class="col-1 col-t-1"><hr><?php echo htmlspecialchars($row_trans["id"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans["sum"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans["bankaccount_nbr_to"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans["statement"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-2 col-t-2"><hr><?php echo htmlspecialchars($row_trans["date"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
				</tr>

		<?php
			}
			echo "</table>";
		?>
		
		<hr><h3>Beérkező utalásaim:</h3><hr>
		<table class="col-12 col-t-12">
			<tr>
				<td class="col-1 col-t-1"><b>Azonosító</b></td>
				<td class="col-3 col-t-3"><b>Utalás összege</b></td>
				<td class="col-3 col-t-3"><b>Kezdeményező számlaszám</b></td>
				<td class="col-3 col-t-3"><b>Közlemény</b></td>
				<td class="col-2 col-t-2"><b>Dátum</b></td>
			</tr>
		
		<?php
			$bankaccount_nbr_from = htmlspecialchars($row_user["bankaccount_nbr_from"], ENT_QUOTES, "UTF-8", TRUE);
			
			$query_trans_2 = mysqli_query($connection, "SELECT * FROM utalasok WHERE bankaccount_nbr_to = '$bankaccount_nbr_from'");
		
			while ($row_trans_2 = mysqli_fetch_assoc($query_trans_2)) {
		?>

				<tr>
					<td class="col-1 col-t-1"><hr><?php echo htmlspecialchars($row_trans_2["id"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans_2["sum"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans_2["bankaccount_nbr_from"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row_trans_2["statement"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-2 col-t-2"><hr><?php echo htmlspecialchars($row_trans_2["date"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
				</tr>

		<?php
			}
			echo "</table>";
		?>
			
	</form>
</article>
</div>

<div class="row">
<footer>Ez egy fiktív neobank felületet bemutató weboldal.<br>Móczó Árpád weboldala</footer>
</div>
</body>
</html>
