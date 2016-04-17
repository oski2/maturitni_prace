<?php
	//Stránka pro přihlašování administrátora
	//Nastavení UTF8
	header('Content-Type: text/html; charset=utf-8');
	
    session_start();

	//Základní funkce, spustí se když klikne na submit.
    if (isset($_POST['submit'])) {
		
		
		//Připojení k databázi
        include("config.php"); 
		
		//Proměnné z hodnot zadaných studentem ve přihlašovacím formuláři
        $filledUsername = strip_tags($_POST['name']);
        $filledPassword = strip_tags($_POST['password']);

		//Proměnná pro SQL vytažení dat z řádky, která odpovídá administrátorovi
        $sql = "SELECT id, adminUsername, adminPassword FROM admin WHERE adminUsername = '$filledUsername' LIMIT 1";
        $query = mysqli_query($conn, $sql); 
         if ($query) {
			//Vytažená data se rozdělí do pole a jednotlivé hodnoty přiřadí proměnným
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUsername = $row[1];
            $dbPassword = $row[2];
         } 
		 
		//V připadě, že se hodnoty v databázi shodují se zadými hodnotami, pošle administrátora na stránku index.php
        if (($filledUsername == $dbUsername && $filledPassword == $dbPassword)) {
            $_SESSION['adminUsername'] = $username;
            $_SESSION['adminID'] = $userId;
            header('Location: index.php');
        }  else {
            echo "Nesprávně zadané jméno či heslo";
        }

    }
?>

<!DOCTYPE html>
<html>

    <head>
	
		<meta charset="UTF-8">
		
        <title>Přihlášení administrátora</title>
		
    </head>
	
    <body>
	
        <h1>Přihlášení administrátora</h1>
		
		<!--Přihlašovací formulář-->
        <form method="post" action="adminlogin.php">
		
            <input type="text" name="name" placeholder="Uživatelské jméno" /><br />
			
            <input type="password" name="password" placeholder="Heslo" /><br />
			
            <input type="submit" name="submit" value="Přihlásit se" />
        
        </form>
    
    </body>

</html>