<?php
//Soubor pro přidávání studentů do databáze na který odkazuje formulář z index.php
//Nastavení UTF8
header('Content-Type: text/html; charset=utf-8');

//Připojení k databázi
include('config.php');


//Nastavení promměných z hodnot zadaných ve formuláři v index.php
$value1 = $_POST['jmeno'];
$value2 = $_POST['prijmeni'];
$value3 = $_POST['rocnik'];
$value4 = $_POST['trida'];
$value5 = $_POST['username'];
$value6 = $_POST['password'];

//Proměnná pro přidání studenta
$sql = "INSERT INTO studenti (jmeno, prijmeni, rocnik, trida, username, password) VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6')";

//Ověření přidání studenta
if ($conn->query($sql) === TRUE) {
    echo('Nový student přidán do databáze.  <a href="index.php">Zpět</a>');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>

