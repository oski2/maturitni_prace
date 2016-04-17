<?php
//Soubor pro pøihlášení k databázi, do ostatních se dává použitím include('config.php');
//Definuj promìnné pro pøihlašování k databázi
$servername = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$dbname = "database";

//Promìnná pro pøipojení k databázi
$conn = new mysqli($servername, $databaseUsername, $databasePassword, $dbname);

//Ovìøení pøipojení
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Nastavení UTF8
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    /*printf("Current character set: %s\n", $conn->character_set_name());*/
}
?>
