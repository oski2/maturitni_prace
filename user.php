<?php
session_start();

//Funkce která zajistí, že se na stránku dostane člověk jen přes login.php
//Poté vybere session variables a zadá je do proměnných jen pro tuto stránku
if(isset($_SESSION['id'])) {
	$userID = $_SESSION['id'];
	$username = $_SESSION['username'];
} else {
	header('Location: login.php');
	die();
}

//Připojení k databázi
include('config.php');

	
?>

<!DOCTYPE html>
<html>

    <head>
	
		<meta charset="utf-8" />
        <title>Welcome</title>
		
    </head>
	
    <body>
	

		<!--Formulář pro vybírání seminářů pro druhý ročník-->
		<form action="studentvyber.php" method="post">
		
			<input type="hidden" name="rowId" value="<?php echo htmlspecialchars($userID); ?>" />
			
			<p>Vyberte si první seminář
				<select name="s1">
					<option value="Matfyz">Matfyz</option>
					<option value="Ekonomika">Ekonomika</option>
					<option value="Biologie">Biologie</option>
					<option value="CAE1">CAE1</option>
					<option value="CAE2">CAE2</option>
					<option value="Dějepis">Dějepis</option>
					<option value="Matematická cvičení">Matematická cvičení</option>
					<option value="Programování">Programování</option>
				</select>
			</p>

			<p>Vyberte si druhý seminář
				<select name="s2">
					<option value="Matfyz">Matfyz</option>
					<option value="Ekonomika">Ekonomika</option>
					<option value="Biologie">Biologie</option>
					<option value="CAE1">CAE1</option>
					<option value="CAE2">CAE2</option>
					<option value="Dějepis">Dějepis</option>
					<option value="Matematická cvičení">Matematická cvičení</option>
					<option value="Programování">Programování</option>
				</select>
			</p>
			
			<input type="submit" value="submit" />
			
		</form>
	
	
		<a href="logout.php">Logout</a>
    </body>
</html>