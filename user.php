<?php
//Uživatelská stránka pro studenty druhého ročníku, vybírají si dva semináře

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
		
        <title>Uživatelský panel</title>
		
		<style>
			select {
				height: 25px;
			}
			
			.logout {
				text-decoration: none;
				color: #000;
				background-color: #eee;
				border: 1px solid black;
				border-radius: 10px;
				padding: 5px;
			}
			
			.logout:hover {
				background-color: #ffa366;
			}
		
		</style>
    </head>
	
    <body>
	
		<?php
		echo 'Přihlášen: ' . $username;
		
		?>
		
		<h4>Vyberte si semináře: </h4>
		
		<!--Formulář pro vybírání seminářů pro druhý ročník-->
		<form action="studentvyber.php" method="post">
		
			<input type="hidden" name="rowId" value="<?php echo htmlspecialchars($userID); ?>" />
			
			<p>Vyberte si první seminář
				<select name="s1">
					<?php
					$sql = "SELECT id, seminar FROM seminare WHERE (rocnik = '2' AND k2 = 1)";
					$query = mysqli_query($conn, $sql);
					
					if ($query) {
						    while ($row = mysqli_fetch_assoc($query)) {
								echo '<option value="' . $row[id] . '">' . $row[seminar] . '</option>';
						}
					}

					?>
				</select>
			</p>

			<p>Vyberte si druhý seminář
				<select name="s2">
					<?php
					$sql = "SELECT id, seminar FROM seminare WHERE (rocnik = '2' AND k2 = 1)";
					$query = mysqli_query($conn, $sql);
					
					if ($query) {
						    while ($row = mysqli_fetch_assoc($query)) {
								echo '<option value="' . $row[id] . '">' . $row[seminar] . '</option>';
						}
					}
					
					?>
				</select>
			</p>
			
			<input type="submit" value="submit" />
			
		</form>
		
		
		<!--Zde se studentovi ukážou vybrané semináře-->
		<h4>Vybrané semináře: </h4>
		<?php

					$ukaz = "SELECT seminar FROM seminare INNER JOIN studenti ON (seminare.id = studenti.s1 OR seminare.id = studenti.s2) WHERE studenti.id = '$userID'";
					$ukazquery = mysqli_query($conn, $ukaz);

					if ($ukazquery) {
						    while ($rada = mysqli_fetch_row($ukazquery)) {
								echo '&middot;' . $rada[0] . '</br>' . ' ';
						}
					}
		
		?>
		</br>
		
		
		<!--Poté, co administrátor deaktivuje určité semináře, deaktivované semináře co si daný student vybral budou studentovi ukázány-->
		<?php
		$druhekolo = "SELECT seminar FROM seminare INNER JOIN studenti ON (seminare.id = studenti.s1 OR seminare.id = studenti.s2) WHERE (studenti.id = '$userID' AND k2 = 0)";
		$druhekoloquery = mysqli_query($conn, $druhekolo);
		
		if (mysqli_num_rows($druhekoloquery) > 0) {
			
			$ukaz = "SELECT seminar FROM seminare INNER JOIN studenti ON (seminare.id = studenti.s1 OR seminare.id = studenti.s2) WHERE (studenti.id = '$userID' AND seminare.k2 = 0)";
			$ukazquery = mysqli_query($conn, $ukaz);
			
			echo '<p style="background-color: red; font-size: 20px; font-weight: bold;">Semináře, které se neotevřely</p>';
			
			if ($ukazquery) {
								while ($rada = mysqli_fetch_row($ukazquery)) {
									echo '&middot;' . $rada[0] . '</br>' . ' ';
							}
						}
		
		}
		
		?>
		
		<!--Formulář pro změnu hesla-->
		<form action="zmenahesla.php" method = "post">
		
			<h4>Změnit heslo: (Nové heslo musí obsahovat minimálně 6 znaků)</h4>
			
			<input type="hidden" name="rowId2" value="<?php echo htmlspecialchars($userID); ?>" />
			
			<input type="password" name="stareheslo" placeholder="Staré heslo"></br>
			
			<input type="password" name="noveheslo" placeholder="Nové heslo"></br>
			
			<input type="password" name="kontrola" placeholder="Nové heslo znovu"></br>
			
			<input type="submit" value="submit"></br>
			
		
		</form>
		
		</br>
		
		<a class="logout" href="logout.php">Odhlásit se</a>
    </body>
</html>