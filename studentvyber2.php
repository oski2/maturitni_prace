<?php
//Stránka pro zápis vybraných seminářů do databáze

	//Nastavení UTF8
	header('Content-Type: text/html; charset=utf-8');
		
	//Připojení k databázi	
	include("config.php");
           


	//Hodnoty z formuláre v user.php jsou prirazeny promenným
	$value1 = $_POST['s1'];
	$value2 = $_POST['s2'];
	$value3 = $_POST['s3'];
	$value4 = $_POST['s4'];
	$value5 = $_POST['blok'];
	$value6 = $_POST['rowId'];

	//Student si nemuže zvolit dva stejné semináře
	if (($value1 == $value2) or ($value2 == $value3) or ($value3 == $value4) or ($value1 == $value3) or ($value1 == $value4) or ($value2 == $value4)) {
		die('Nemůžete si vybrat dva stejné semináře. Prosím, vraťte se na stránku výběru seminářu a zvolte si dva ruzné semináře: <a href="user2.php">Výběr seminářů</a>');
	}


	//Proměnná pro aktualizaci řádky 
	$sql = "UPDATE studenti SET blok='$value5', s1='$value1', s2='$value2', s3='$value3', s4='$value4' WHERE id='$value6'";

	//Ověrení aktualizace řádky a odkazy
	if ($conn->query($sql) === TRUE) {
		echo('Semináře vybrány. <a href="logout.php">Odhlásit se</a>   <a href="user2.php">Zpět na výběr seminářu</a>');
	}
	else {
		echo("Error: " . $sql . "<br>" . $conn->error);
	}



	$conn->close();
?>