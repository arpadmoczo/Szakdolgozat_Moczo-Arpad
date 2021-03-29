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
			
			$query = "SELECT * FROM users WHERE username='$username' OR password='$password'";
			$query_result = mysqli_query($connection, $query);
			$num_rows = mysqli_num_rows($query_result);
			$row = mysqli_fetch_assoc($query_result);
				
			if (($num_rows == 0) && ($password == $password2)) {
				$insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
				$insert_result = mysqli_query($connection, $insert);
				
				if (!$insert_result) {
					$_SESSION['reg_error'] = "<script>alert ('Sikertelen regisztráció!')</script>";
					header("Location:register.php");
				}
				else {
					$_SESSION['reg'] = "<script>alert ('Regisztrációja sikeresen megtörtént! Jelentkezzen be!')</script>";
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
	
//Feedback
	if (isset($_POST["feedback"])) {            
		$name = $_POST['name'];
        $feedback = $_POST['feedback'];
			
		$sql = "INSERT INTO feedback (name, feedback) VALUES ('$name', '$feedback')";
			
		if(mysqli_query($connection, $sql)){
			echo "<script>alert('A visszajelzést sikeresen elküldte!')</script>";
			header("Location:aboutus.php");
		} else{
			echo "<script>alert('A visszajelzést nem sikerült elküldeni. Kérem, próbálja újra!')</script>" . mysqli_error($connection);
			header("Location:aboutus.php");
		}
	}
?>