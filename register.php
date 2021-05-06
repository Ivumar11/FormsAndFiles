<!DOCTYPE html>
<html>
<head>
	<title>Practising files and forms</title>
</head>
<body>
<center>
    <h3>REGISTRATION </h3>
    <form action="processor.php" method="POST">
        <input type="text" name="f_name" placeholder="First name">
        <input type="text" name="l_name" placeholder="Last name">
        <input type="text" name="u_name" placeholder="Username">
        <input type="password" name="password" placeholder="Enter a strong password">
        <input type="submit" name="register" value="REGISTER"></input>
    </form>
    <p> Already have an account? CLick <a href="login.php">here</a> to login.</p>
</center>
</body>
</html>