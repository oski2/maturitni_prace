<?php
//Soubor pro přidávání seminářů do databáze na který odkazuje formulář z index.php
//Nastavení UTF8
header('Content-Type: text/html; charset=utf-8');

//Připojení k databázi
include('config.php');


//Nastavení promměných z hodnot zadaných ve formuláři v index.php
$value1 = $_POST['seminar'];
$value2 = $_POST['rocnikseminare'];

//Ověření, zdali admin zadal všechny informace
if (empty($value1) or empty($value2)) {
	die ('Prosím, vyplňte všechna pole. <a href="index.php">Zpět</a>');
}

//Proměnná pro přidání semiáře
$sql = "INSERT INTO seminare (seminar, rocnik) VALUES ('$value1', '$value2')";

//Ověření přidání semináře
if ($conn->query($sql) === TRUE) {
    echo('Nový seminář přidán do databáze.  <a href="index.php">Zpět</a>');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>