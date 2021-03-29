<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

//Feedback
	if (isset($_POST["feedback_submit"])) {
		//Anti-CSRF token ellenőrzése
		if (hash_equals($_SESSION['token'],$_POST['anti_csrf'])) {
			$name = htmlspecialchars($_POST['name'], ENT_QUOTES, "UTF-8", TRUE);
			$feedback = htmlspecialchars($_POST['feedback'], ENT_QUOTES, "UTF-8", TRUE);
				
			$sql = "INSERT INTO feedback (name, feedback) VALUES ('$name', '$feedback')";
				
			if(mysqli_query($connection, $sql)){
				$_SESSION['feedback'] = "<script>alert('A visszajelzést sikeresen elküldte!')</script>";
				header("Location:aboutus.php");
				exit;
			} else{
				$_SESSION['feedback_error'] = "<script>alert('A visszajelzést nem sikerült elküldeni. Kérem, próbálja újra!')</script>" . mysqli_error($connection);
				header("Location:aboutus.php");
				exit;
			}
		} else {
			$_SESSION['csrf_error'] = "A HTTP kérés indításához nem megfelelő értéket adott meg!";
			header("Location:aboutus.php");
			exit;
		}
	}
?>