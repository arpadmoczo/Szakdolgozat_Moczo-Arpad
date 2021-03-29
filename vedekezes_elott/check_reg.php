<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

//Regisztráció
	if (isset($_POST["register"])) {
			$username = $_POST['username_reg'];
			$email = $_POST['email_reg'];
            $password = $_POST['password_reg'];
			$password2 = $_POST['password2_reg'];
			
			$query = "SELECT * FROM users WHERE username='$username' OR password='$password' OR email='$email'";
			$query_result = mysqli_query($connection, $query);
			$num_rows = mysqli_num_rows($query_result);
			$row = mysqli_fetch_assoc($query_result);
				
			if (($num_rows == 0) && ($password == $password2)) {
				$bankaccount_nbr_from = rand(100,999).rand(100,999).rand(100,999);
				
				$insert = "INSERT INTO users (username, password, email, bankaccount_nbr_from) VALUES ('$username', '$password', '$email', '$bankaccount_nbr_from')";
				$insert_result = mysqli_query($connection, $insert);
				
				
				if (!$insert_result) {
					$_SESSION['reg_error'] = "<script>alert('Sikertelen regisztráció!')</script>";
					header("Location:register.php");
				}
				else {
					$_SESSION['reg'] = "<script>alert('Regisztrációja sikeresen megtörtént! Jelentkezzen be!')</script>";
					header("Location:login.php");
				}  
			}
			
			$_SESSION['errors'] = array(
				"email" => '',
				"password" => '',
				"password2" => ''
			);
			
			if ($num_rows >= 1) {
				if ($email == $row['email']) {
					$_SESSION['errors']['email'] = "<br><span style='color:red'>A megadott email cím már használatban van. Kérjük adj meg egy másik emailt!</span>";
					header("Location:register.php");
				}
				if ($password == $row['password']) {
					$_SESSION['errors']['password'] = "<br><span style='color:red'>A megadott jelszó már használatban van. Kérjük adj meg egy másik jelszót!</span>";
					header("Location:register.php");
				}				  
				if ($password !== $password2) {
					$_SESSION['errors']['password2'] = "<br><span style='color:red'>A két jelszó nem egyezik meg!</span>";
					header("Location:register.php");
				}      
			} else {
				if ($password !== $password2) {
					$_SESSION['errors']['password2'] = "<br><span style='color:red'>A két jelszó nem egyezik meg!</span>";
					header("Location:register.php");
				}
			}
	} else {
        header("Location:register.php");
        exit;
    }
?>