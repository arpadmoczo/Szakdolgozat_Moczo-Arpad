<?php 
session_start();

require_once("connect.php");
mysqli_set_charset($connection, 'utf8');

//Feedback
	if (isset($_POST["feedback_submit"])) {            
		$name = $_POST['name'];
        $feedback = $_POST['feedback'];
			
		$sql = "INSERT INTO feedback (name, feedback) VALUES ('$name', '$feedback')";
			
		if(mysqli_query($connection, $sql)){
			$_SESSION['feedback'] = "<script>alert('A visszajelzést sikeresen elküldte!')</script>";
			header("Location:aboutus.php");
		} else{
			$_SESSION['feedback_error'] = "<script>alert('A visszajelzést nem sikerült elküldeni. Kérem, próbálja újra!')</script>" . mysqli_error($connection);
			header("Location:aboutus.php");
		}
	}
?>