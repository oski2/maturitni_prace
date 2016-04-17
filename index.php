<?php
//Administrátorská stránka, přidávání studentů, seminářů, aktivace a mazání seminářů, přehled přihlášení
session_start();

/*Funkce, která zajistí, že se na stránku dostane člověk jen přes login.php
Poté vybere session variables a zadá je do proměnných jen pro tuto stránku*/
if(isset($_SESSION['adminID'])) {
	$userID = $_SESSION['adminID'];
	$username = $_SESSION['adminUsername'];
} else {
	header('Location: adminlogin.php');
	die();
}

//Připojení k databázi
include('config.php');


?>

<html>

<head>

    <meta charset="UTF-8">
	
	<title>Administrátorský panel</title>
	
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
		}
		th.rotate {
			height: 140px;
			white-space: nowrap;
			border: none !important;
		}

		th.rotate > div {
			transform: 

			translate(18px, 51px)
			rotate(300deg);
			width: 30px;
		}
		
		th.rotate > div > span {
			border-bottom: 1px solid #ccc;
			padding: 0px 10px;
		}
		
		#studentForm {
			float: left;
			width: 50%;
		}
		
		#seminarForm {
			float: left;
			width: 50%;
		}
		
		#aktivaceTable {
			padding: 350px 0 100px;
			width: 100%;
		}
		
		#pocetTable {
			clear: both;
			width: 100%;
		}
		
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

	<h1>Administrátorský panel</h1>
	
    <!-- Formulář pro přidávání studentů do databáze-->
    <div id="studentForm">
	<form action="studentplus.php" method="post" >
	
	<h4>Formulář pro přidávání studentů do databáze</h4>
	
        <p>Jméno studenta <input type="text" name="jmeno" /></p>
		
        <p>Příjmení studenta <input type="text" name="prijmeni" /></p>
		
        <p>Ročník studenta
        <select name="rocnik">
            <option value="2">2. Ročník</option>
            <option value="3">3. Ročník</option>
        </select>
        </p>
		
        <p>Třída studenta
        <select name="trida">
            <option value="XA">Sexta A</option>
            <option value="XB">Sexta B</option>
            <option value="2A">2. A</option>
            <option value="MA">Septima A</option>
            <option value="MB">Septima B</option>
            <option value="3A">3. A</option>
        </select>
        </p>

		<p>E - mail studenta: <input type="text" name="username" /></p>
		
		<p>Heslo studenta: <input type="text" name="password" /></p>
		
        <input type="submit" value="Přidej studenta" />
		
    </form></div>
	

	<!--Formulář pro přidávání číslovaných seminářů do databáze-->
	<div id="seminarForm">
	<form action="seminarplus.php" method="post">
	
	<h4>Formulář pro přidávání číslovaných seminářů do databáze</h4>
	
		<p>Jméno semináře: <input type="text" name="seminar" /></p>
		
		<p>Ročník, do kterého seminář patří:
			<select name="rocnikseminare">
				<option value="2">2. ročník</option>
				<option value="3">3. ročník</option>
			</select>
		</p>
		
		<input type="submit" value="Přidej seminář" />
		
	</form></div>
	
	
	<!--Tabulka pro aktivaci či deaktivaci seminářů a jejich mazání-->
	<div  id="aktivaceTable">
	<table>
	
	<h4>Tabulka pro aktivaci či deaktivaci seminářů a jejich mazání</h4>
	
		<tr>
			<th>Ročník</th>
			<th>Deaktivace/Aktivace</th>
			<th>Postup do druhého kola (1=Ano, 0=Ne)</th>
			<th>Smazání semináře</th>
		</tr>	
		
		<?php
			$sql = "SELECT id, seminar, rocnik, k2 FROM seminare";
			$query = mysqli_query($conn, $sql);
			
			if ($query) {
				while ($row = mysqli_fetch_assoc($query)) {
					echo '<tr>
					<td>' . $row['rocnik'] . '</td>
					<td><form action="druhekolo.php" method="post">
							<input type="hidden" name="rowId" value="' . $row['id'] . '" />
							<input type="hidden" name="rowK2" value="' . $row['k2'] . '" />
							<input type="submit" value="' . $row['seminar'] . '" ></form></td>
					<td>' . $row['k2'] . '</td>
					<td><form action="seminarsmazat.php" method="post">
							<input type="hidden" name="rowId2" value="' . $row['id'] . '" />
							<input type="submit" value="Smazat: ' . $row['seminar'] . '" ></form>
							</td>
					</tr>';
				}
			}
		?>
		
	</table></div>
	

			
	<!--Tabulka s počtem studentů na seminářích, slouží k přehledu a na základě ní může administrátor provádět aktivaci/deaktivaci-->	
	<div id="pocetTable" >
	<table style="border: none;">
	
	<h4>Tabulka s počtem studentů na seminářích, slouží k přehledu a na základě ní můžete provádět aktivaci/deaktivaci</h4>
	</br></br></br></br></br></br></br>
		<tr>
			<th style="border: none"> &nbsp;</th>
			
			<?php
			$sql = "SELECT id, seminar, rocnik, k2 FROM seminare";
			$query = mysqli_query($conn, $sql);
				if ($query) {
					while ($row = mysqli_fetch_assoc($query)) {
						echo '<th class="rotate"><div><span>' . $row['seminar'] . ' - ' . $row['rocnik'] . '. Ročník' . '</span></div></th>';
					}
				}
			?>
		</tr>
		
		<tr>
			<td>Celkový počet přihlášených studentů</td>
			
			<?php
			$count = mysqli_query($conn, "SELECT COUNT(1) FROM seminare");
			$fetch = mysqli_fetch_array($count);
			
			//$x je počet seminářů
			$x = $fetch[0];
			$i = 1;
			
			
		
			
			while ($i <= $x) {
					$Scount  = "SELECT COUNT(1) FROM studenti WHERE s1 = $i OR s2 = $i OR s3 = $i OR s4 = $i";
					$Sresult = mysqli_query($conn, $Scount);
					$Sfetch = mysqli_fetch_array($Sresult);
					echo '<td>' . $Sfetch[0] . '</td>';
					$i++;	
			}
			
			
			?>
			
		</tr>
		
	
	</table></div>
	
	
	</br></br>

	<a class="logout" href="adminlogout.php">Odhlásit se</a>




</body>
</html>

