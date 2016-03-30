
<?php
	//Nastavení UTF8
	header('Content-Type: text/html; charset=utf-8');
	
	//Připojení k databázi
	include("config.php");
			   



	//Hodnoty z formuláře v user.php jsou přiřazeny proměnným
	$value1 = $_POST['s1'];
	$value2 = $_POST['s2'];
	$value3 = $_POST['rowId'];

	//Student si nemůže zvolit dva stejné semináře
	if ($value1 == $value2) {
		die('Nemůžete si vybrat dva stejné semináře. Prosím, vraťte se na stránku výběru seminářů a zvolta si dva různé semináře: <a href="user.php">Výběr seminářů</a>');
	}

	//Proměnná pro aktualizaci řádky 
	$sql = "UPDATE studenti SET s1='$value1', s2='$value2' WHERE id='$value3'";

	//Ověření aktualizace řádky a odkazy
	if ($conn->query($sql) === TRUE) {
		echo('Semináře vybrány. <a href="logout.php">Odhlásit se</a>   <a href="user.php">Zpět na výběr seminářů</a>');
	}
	else {
		echo("Error: " . $sql . "<br>" . $conn->error);
	}



	$conn->close();
?>

