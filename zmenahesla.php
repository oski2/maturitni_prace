<?php
//Změna hesla pro studenta druhého ročníku
//Nastavení UTF8
header('Content-Type: text/html; charset=utf-8');
		
//Pripojení k databázi	
include("config.php");
           
//Hodnoty z formuláře v user.php jsou přiřazeny proměnným
	$value1 = strip_tags($_POST['stareheslo']);
	$value2 = strip_tags($_POST['noveheslo']);
	$value3 = strip_tags($_POST['kontrola']);
	$value4 = $_POST['rowId2'];
	
//Kontrola zdali je nové heslo pro kontrolu zadáno stejně jako nové heslo	
if (!($value2 == $value3)) {
	die ('Nové heslo pro kontrolu jste zadali jinak, prosím, vraťte se na uživatelskou stránku a zadejte hesla znovu: <a href="user.php">Výběr seminářů</a>');
}

//Kontrola zdali je nové heslo dostatečně dlouhé
if (strlen($value2) < 6 ){
	die ('Nové helo je příliš krátké. Prosím, zadejte heslo alespoň 6 znaků dlouhé. <a href="user.php">Zpět na výběr seminářů</a>');
}	

//Vytažení přihlašovacích dat z databáze studentů
$sql = "SELECT username, password FROM studenti WHERE id = $value4";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

//Kontrola zdali je staré heslo zadáno správně, jestliže je, změní heslo
if (!($value1 == $row['password'])) {
	die ('Zadali jste špatně staré heslo, prosím, vraťte se na uživatelskou stránku a zadejte hesla znovu: <a href="user.php">Výběr seminářů</a>');
} else {
	$zmena = "UPDATE studenti SET password = '$value2' WHERE id = '$value4'";
	$zmenahesla = mysqli_query($conn, $zmena);
	
	if ($zmenahesla) {
		echo 'Heslo změněno <a href="user.php">Zpět na výběr seminářů</a>';
	} else {
		echo 'Error';
	}
}


$conn->close();

		   
		   
?>