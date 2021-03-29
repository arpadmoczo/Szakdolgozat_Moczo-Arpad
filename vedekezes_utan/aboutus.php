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
        var errormsg = "Kérem, adja meg a nevét és töltse ki a visszajelzés mezőt!";

        if (document.getElementById('name').value == "" ||
            document.getElementById('feedback').value == "") {
            document.getElementById('errors_feedback').innerText = errormsg;
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
				<li id="current" class="col-3 col-t-6"><a href="aboutus.php">Rólunk</a></li>
				<li class="col-3 col-t-6"><a href="login.php">Bejelentkezés</a></li>		
				<li class="col-3 col-t-6"><a href="register.php">Fiók létrehozása</a></li>		
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
	<h3>A vállalatról</h3>
	<p class="col-7 col-t-6">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dignissim ornare tortor, nec ultricies orci ornare consequat. Mauris congue erat eget mauris faucibus rhoncus. Pellentesque mattis enim tortor. Donec rhoncus semper est, sed sagittis ligula tempor eu. Aliquam ullamcorper rhoncus odio a blandit. Morbi at arcu id purus tempus pretium. Morbi a nisl commodo, accumsan ex ut, sodales enim. Nam velit sapien, bibendum eget lobortis et, accumsan sed nulla. Sed dui libero, varius in velit sed, dignissim mollis nunc. 
	</p>
	<figure class="col-5 col-t-6">
		<img src="img/rolunk.jpeg" alt="Harmadik mintafotó." width="600">
		<figcaption>Mintafotó 3.</figcaption>
	</figure>
	
	<h3>Missziónk, víziónk</h3>
	<p class="bekezdes">
		Curabitur malesuada sit amet augue id interdum. Vivamus vestibulum vestibulum justo efficitur mollis. Mauris ultrices, nisl sed eleifend pulvinar, nulla mi vulputate arcu, vitae fermentum eros mi at felis. Morbi vestibulum sem in nulla eleifend, non elementum nulla feugiat. Nam eget iaculis magna, in aliquet nibh. Aliquam ut blandit quam. Integer in ipsum eu libero scelerisque dictum. Quisque euismod libero metus.
	</p>
	<p class="bekezdes">
		Praesent et quam auctor, porttitor nulla ac, rhoncus tellus. Aenean gravida eget neque et maximus. Nam hendrerit pellentesque nisi, eu consectetur arcu ultrices non. Maecenas eleifend pulvinar sem, eget vehicula leo rhoncus vel. Ut dictum dictum libero eget sodales. Phasellus pulvinar magna non luctus lacinia. Aliquam accumsan est in dolor vestibulum, vel interdum sem eleifend. Vestibulum lobortis massa mi, vitae tempus diam tincidunt ut. Praesent laoreet nulla massa, a finibus ante scelerisque nec. Aliquam ac condimentum nunc. Donec consectetur nunc lorem, ac mattis metus maximus sit amet. Praesent hendrerit purus ligula, a tristique ante consectetur vitae.
	</p>
	
	<h3>Csapatunk</h3>
	<p class="bekezdes">
		Suspendisse venenatis ipsum fermentum eros porta, sed ultricies arcu facilisis. Quisque a vehicula augue. Phasellus in fringilla nisl. Curabitur sed hendrerit nibh. Aliquam eget vehicula nibh. Proin in nunc eu nisi consequat venenatis. Aliquam ac augue ac ipsum commodo molestie. Morbi vehicula pulvinar lectus, id varius sapien porta id.
	</p>
	<hr>
	<h3 id="feedback">Számít a véleménye! Küldjön visszajelzést!</h3>
	<hr>
	<div id="errors_feedback">
	<?php
		if (isset($_SESSION['feedback'])) {
			echo $_SESSION['feedback'];
			unset($_SESSION['feedback']);
		}
		if (isset($_SESSION['feedback_error'])) {
			echo $_SESSION['feedback_error'];
			unset($_SESSION['feedback_error']);
		}
		if (isset($_SESSION['csrf_error'])) {
			echo htmlspecialchars($_SESSION['csrf_error'], ENT_QUOTES, "UTF-8", TRUE);
			unset($_SESSION['csrf_error']);
		}
	?>
	</div>
	<form  action="check_feedback.php" onSubmit="return blankcheck()" method="POST" id="feedback_form">
		<table class="col-12 col-t-12">
			<tr>
				<td class="col-3 col-t-3"><b>Visszajelzést küldő neve</b></td>
				<td class="col-8 col-t-8"><input type="text" name="name" id="name"></td>
				
			</tr>
			<tr>
				<td class="col-3 col-t-3"><b>Visszajelzés</b></td>
				<td class="col-9 col-t-9"><input type="text" name="feedback" id="feedback" placeholder="Írja ide visszajelzését..."></td>
			</tr>
			<tr>
				<td class="col-3 col-t-3"><input type="hidden" name="anti_csrf" value="<?php echo $_SESSION['token'] ?>"></td>
				<td class="col-9 col-t-9"><input type="submit" name="feedback_submit" value="Küldés"></td>
			</tr>
		</table>
	</form>
	
	<?php
		require_once("connect.php");
		$query = mysqli_query($connection, "SELECT * FROM feedback");
	?>
	
	<hr>
	<h3 id="prev_feedback">Korábbi ügyfél visszajelzések:</h3>
	<hr>
	
	<table class="col-12 col-t-12">
		<tr>
			<td class="col-3 col-t-3"><b>Visszajelzést küldő neve</b></td>
			<td class="col-9 col-t-9"><b>Visszajelzés</b></td>
		</tr>
	<?php
			while ($row = mysqli_fetch_assoc($query)) {
	?>

				<tr>
					<td class="col-3 col-t-3"><hr><?php echo htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
					<td class="col-9 col-t-9"><hr><?php echo htmlspecialchars($row["feedback"], ENT_QUOTES, "UTF-8", TRUE); ?></td>
				</tr>

	<?php
		} echo "</table>";
	?>
</article>
</div>

<div class="row">
<footer>Ez egy fiktív neobank felületet bemutató weboldal.<br>Móczó Árpád weboldala</footer>
</div>

</body>
</html>
