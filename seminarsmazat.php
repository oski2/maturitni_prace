<?php
//Smazání semináře
//Nastavení UTF8
header('Content-Type: text/html; charset=utf-8');
//Připojení k databázi
include('config.php');



$value1 = $_POST['rowId2'];

$sql = "DELETE FROM seminare WHERE id = '$value1'";

if ($conn->query($sql) === TRUE) {
			echo('Seminář smazán  <a href="index.php">Zpet</a>');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}



$conn->close();

?>