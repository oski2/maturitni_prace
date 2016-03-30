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
<html>

	<head>
	
		<meta charset="UTF-8">
		<title>3. Rocnik</title>
		
	</head>

	<body>
	
		<p>Vybírání seminářů pro třetí ročník</p>
	
		<!--Formulář pro vybírání seminářů pro druhý ročník-->
		<form action="studentvyber2.php" method="post">
		
			<input type="hidden" name="rowId" value="<?php echo htmlspecialchars($userID); ?>" />
			
			<p>Vyberte si blok přemětů
				<select name="blok">
					<option value="Technicky">Technický</option>
					<option value="Ekonomicky">Ekonomický</option>
					<option value="Prirodovedny">Přírodovědný</option>
					<option value="Humanitni">Humanitní</option>
				</select>
			</p>
			
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
			
			<p>Vyberte si třetí seminář
				<select name="s3">
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
			
			<p>Vyberte si čtvrtý seminář (nepovinný)
				<select name="s4">
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
	
		<!--Odkaz na odhlašovací stránku-->
		<a href="logout.php">Logout</a>	



</body>

</html>