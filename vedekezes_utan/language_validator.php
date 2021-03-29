<?php
//A nyelvválasztó kódjának forrása: Damn Vulnerable Web Application, 2021 (Az alkalmazás a következő linken tölthető le: https://dvwa.co.uk/).
// Létezik input érték?

	if ( array_key_exists( "default", $_GET ) && !is_null ($_GET['default']) ) {

		# Engedélyezett nyelvek listája
		switch ($_GET['default']) {
			case "Magyar":
			case "Angol":
			case "Német":
			case "Francia":
			case "Spanyol":
				# OK
				break;
			default:
				header ("location: ?default=Magyar");
				exit;
		}
	}

?>
