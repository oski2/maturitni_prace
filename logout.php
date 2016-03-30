<?php
    session_start();
	
	//Session variables jsou smazány
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
    
        <a href="login.php">Login</a>
		
    </body>
	
</html>