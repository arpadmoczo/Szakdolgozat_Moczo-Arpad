<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

        if (isset($_POST["transaction"])) {
			//Anti-CSRF token ellenőrzése
			if (hash_equals($_SESSION['token'],$_POST['anti_csrf'])) {
				$sum = htmlspecialchars($_POST['sum'], ENT_QUOTES, "UTF-8", TRUE);
				$statement = htmlspecialchars($_POST['statement'], ENT_QUOTES, "UTF-8", TRUE);
				$nbr_1 = htmlspecialchars($_POST['nbr_1'], ENT_QUOTES, "UTF-8", TRUE);
				$nbr_2 = htmlspecialchars($_POST['nbr_2'], ENT_QUOTES, "UTF-8", TRUE);
				$nbr_3 = htmlspecialchars($_POST['nbr_3'], ENT_QUOTES, "UTF-8", TRUE);
				
				$bankaccount_nbr_to = $nbr_1.$nbr_2.$nbr_3;
				
				$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, "UTF-8", TRUE);
				
				$query_user = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
				$row_user = mysqli_fetch_assoc($query_user);
				$bankaccount_nbr_from = htmlspecialchars($row_user['bankaccount_nbr_from'], ENT_QUOTES, "UTF-8", TRUE);
				
				$date = date("Y-m-d");
				
				$sql = "INSERT INTO utalasok (sum, statement, username, bankaccount_nbr_to, bankaccount_nbr_from, date) VALUES ('$sum', '$statement', '$username', '$bankaccount_nbr_to', '$bankaccount_nbr_from', '$date')";
				
				if(mysqli_query($connection, $sql)){
					$_SESSION['trans'] = "<script>alert('A tranzakció sikeresen megtörtént!')</script>";
					header("Location:transaction.php");
				} else{
					$_SESSION['trans_error'] = "<script>alert('A tranzakció sikertelen. Kérem, próbálja újra!')</script>" . mysqli_error($connection);
					header("Location:transaction.php");
				}
			} else {
				$_SESSION['csrf_error'] = "A HTTP kérés indításához nem megfelelő értéket adott meg!";
				header("Location:transaction.php");
				exit;
			}
		}
?>