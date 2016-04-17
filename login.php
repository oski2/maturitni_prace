<?php
	//Stránka pro přihlašování studentů
	//Nastavení UTF8
	header('Content-Type: text/html; charset=utf-8');
	
	session_start();
 
	//Základní funkce, spustí se když klikne na submit.
    if (isset($_POST['submit'])) {
		
		//Připojení k databázi
        include("config.php"); 
		
		//Proměnné z hodnot zadaných studentem ve přihlašovacím formuláři
        $username = strip_tags($_POST['name']);
        $password = strip_tags($_POST['password']);
        
		//Proměnná pro SQL vytažení dat z řádky, která odpovídá studentovi
        $sql = "SELECT id, username, password, rocnik FROM studenti WHERE username = '$username' LIMIT 1";
        $query = mysqli_query($conn, $sql); 
         if ($query) {
			//Funkce která vytažená data rozdělí do pole a jednotlivé hodnoty přiřadí proměnným
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUsername = $row[1];
            $dbPassword = $row[2];
			$dbRocnik = $row[3];
         }
		 
		
		//Funkce která v připadě, že se hodnoty v databázi shodují se zadými hodnotami, pošle studenta na stránku podle toho, jaký je ročník
        if (($username == $dbUsername && $password == $dbPassword) && ($dbRocnik == 3)) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userId;
            header('Location: user2.php');
        } elseif (($username == $dbUsername && $password == $dbPassword) && ($dbRocnik == 2)) {
			$_SESSION['username'] = $username;
            $_SESSION['id'] = $userId;
            header('Location: user.php');
		} else {
            echo "Nesprávně zadáno jméno nebo heslo";
        }

    }
?>

<!DOCTYPE html>
<html>

    <head>
	
		<meta charset="UTF-8">
		
        <title>Přihlášení studenta</title>
		
    </head>
	
    <body>
	
        <h1>Přihlášení studenta</h1>
		
		<!--Přihlašovací formulář-->
		
        <form method="post" action="login.php">
		
            <input type="text" name="name" placeholder="Uživatelské jméno" /><br />
			
            <input type="password" name="password" placeholder="Heslo" /><br />
			
            <input type="submit" name="submit" value="Přihlásit se" />
        
        </form>
    
    </body>

</html>