<?php
//Nastavení UTF8
header('Content-Type: text/html; charset=utf-8');
//Připojení k databázi
include('config.php');



$value1 = $_POST['rowId'];
$value2 = $_POST['rowK2'];

if ($value2 == 1) {
	
		$sql = "UPDATE seminare SET k2 = 0 WHERE id = '$value1'";

		if ($conn->query($sql) === TRUE) {
			echo('Seminář deaktivován  <a href="index.php">Zpět</a>');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
} elseif ($value2 == 0) {
		$sql = "UPDATE seminare SET k2 = 1 WHERE id = '$value1'";

		if ($conn->query($sql) === TRUE) {
			echo('Seminář Aktivován  <a href="index.php">Zpět</a>');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
} else {
	echo 'error';
}



$conn->close();

?>