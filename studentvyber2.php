<?php
	//Nastaven� UTF8
	header('Content-Type: text/html; charset=utf-8');
		
	//Pripojen� k datab�zi	
	include("config.php");
           


	//Hodnoty z formul�re v user.php jsou prirazeny promenn�m
	$value1 = $_POST['s1'];
	$value2 = $_POST['s2'];
	$value3 = $_POST['s3'];
	$value4 = $_POST['s4'];
	$value5 = $_POST['blok'];
	$value6 = $_POST['rowId'];

	//Student si nemu�e zvolit dva stejn� semin�re
	if (($value1 == $value2) or ($value2 == $value3) or ($value3 == $value4) or ($value1 == $value3) or ($value1 == $value4) or ($value2 == $value4)) {
		die('Nemu�ete si vybrat dva stejn� semin�re. Pros�m, vratte se na str�nku v�beru semin�ru a zvolta si dva ruzn� semin�re: <a href="user.php">V�ber semin�ru</a>');
	}


	//Promenn� pro aktualizaci r�dky 
	$sql = "UPDATE studenti SET blok='$value5', s1='$value1', s2='$value2', s3='$value3', s4='$value4' WHERE id='$value6'";

	//Overen� aktualizace r�dky a odkazy
	if ($conn->query($sql) === TRUE) {
		echo('Semin�re vybr�ny. <a href="logout.php">Odhl�sit se</a>   <a href="user2.php">Zpet na v�ber semin�ru</a>');
	}
	else {
		echo("Error: " . $sql . "<br>" . $conn->error);
	}



	$conn->close();
?>