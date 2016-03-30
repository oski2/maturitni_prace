<?php
	//Nastavení UTF8
	header('Content-Type: text/html; charset=utf-8');
		
	//Pripojení k databázi	
	include("config.php");
           


	//Hodnoty z formuláre v user.php jsou prirazeny promenným
	$value1 = $_POST['s1'];
	$value2 = $_POST['s2'];
	$value3 = $_POST['s3'];
	$value4 = $_POST['s4'];
	$value5 = $_POST['blok'];
	$value6 = $_POST['rowId'];

	//Student si nemuže zvolit dva stejné semináre
	if (($value1 == $value2) or ($value2 == $value3) or ($value3 == $value4) or ($value1 == $value3) or ($value1 == $value4) or ($value2 == $value4)) {
		die('Nemužete si vybrat dva stejné semináre. Prosím, vratte se na stránku výberu semináru a zvolta si dva ruzné semináre: <a href="user.php">Výber semináru</a>');
	}


	//Promenná pro aktualizaci rádky 
	$sql = "UPDATE studenti SET blok='$value5', s1='$value1', s2='$value2', s3='$value3', s4='$value4' WHERE id='$value6'";

	//Overení aktualizace rádky a odkazy
	if ($conn->query($sql) === TRUE) {
		echo('Semináre vybrány. <a href="logout.php">Odhlásit se</a>   <a href="user2.php">Zpet na výber semináru</a>');
	}
	else {
		echo("Error: " . $sql . "<br>" . $conn->error);
	}



	$conn->close();
?>