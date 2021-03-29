<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

//Bejelentkezés
    if (isset($_POST["login"])) {
		//Anti-CSRF token ellenőrzése
		if (hash_equals($_SESSION['token'],$_POST['anti_csrf'])) {
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES, "UTF-8", TRUE);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, "UTF-8", TRUE);

            $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
			$row = mysqli_fetch_assoc($query);

        if (mysqli_num_rows($query) == 1 && password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = TRUE;
				
				setcookie("user_cookie", $_SESSION['username'].strval(rand()), 0, "/", "192.168.***.***", true, true);
                header("Location:userpage.php");
                exit;
        } else {
                header("Location:login.php?nomatch=true");
                exit;
            }
		} else {
			$_SESSION['csrf_error'] = "A HTTP kérés indításához nem megfelelő értéket adott meg!";
			header("Location:login.php");
			exit;
		}
    } else {
        header("Location:login.php");
        exit;
    }
?>