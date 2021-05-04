<!DOCTYPE html>
<html>
<head>
	<title>Practising files and forms</title>
</head>
<body>
    <form action="processor.php" method="POST">
        <input type="password" name="old_password" placeholder="Enter a strong password">
        <input type="password" name="new_password" placeholder="Enter a strong password">
        <input type="submit" name="reset" value="RESET"></input>
    </form>
    <p>Forgotten your password? CLick <a href="reset.php">here</a> to reset your password</p>
</body>
</html>