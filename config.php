<?php
//Soubor pro p�ihl�en� k datab�zi, do ostatn�ch se d�v� pou�it�m include('config.php');
//Definuj prom�nn� pro p�ihla�ov�n� k datab�zi
$servername = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$dbname = "database";

//Prom�nn� pro p�ipojen� k datab�zi
$conn = new mysqli($servername, $databaseUsername, $databasePassword, $dbname);

//Ov��en� p�ipojen�
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Nastaven� UTF8
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    /*printf("Current character set: %s\n", $conn->character_set_name());*/
}
?>
