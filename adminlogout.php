<?php
//Odhlášení administrátora
    session_start();
	
	session_destroy();
?>

<!DOCTYPE html>
<html>

    <head>
	
		<meta charset="UTF-8">
        <title>Odhlášení</title>
		
    </head>
	
    <body>
	
        <p>Odhlášení proběhlo úspěšně.</p><br />
    
        <a href="adminlogin.php">Přihlásit se</a>
		
    </body>
	
</html>