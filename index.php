<html>
<head>
    <meta charset="UTF-8">
</head>

<body>
    <!-- Formulář pro přidávání studentů do databáze-->
    <form action="studentplus.php" method="post" >
	
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

		<p>Uživatelské jméno studenta: <input type="text" name="username" /></p>
		
		<p>Heslo studenta: <input type="text" name="password" /></p>
		
        <input type="submit" value="Přidej studenta" />
		
    </form>







</body>
</html>

