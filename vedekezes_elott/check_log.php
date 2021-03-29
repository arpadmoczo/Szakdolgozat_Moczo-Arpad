<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

//Bejelentkezés
    if (isset($_POST["login"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username' 
            AND password='$password'");

        if (mysqli_num_rows($query) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = TRUE;
				
				setcookie('user_cookie', $_SESSION['username'].strval(rand() . "\n"));
                header("Location:userpage.php");
                exit;
        } else {
                header("Location:login.php?nomatch=true");
                exit;
            }
    } else {
        header("Location:login.php");
        exit;
    }
?>