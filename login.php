<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Practising files and forms</title>
</head>
<body>
<center>
<?php
    if (isset($_SESSION['just_registered'])) {
        echo '<h3>You have successfully registered your account.</h3>
        </p>Enter your details below to login</p>';
    }
    if (isset($_SESSION['msg'])) {
        echo "<h3>".$_SESSION['msg']."</h3>";
    }
    ?>
    <h3> LOGIN </h3>
    <form action="processor.php" method="POST">
        <input type="text" name="u_name" placeholder="Username">
        <input type="password" name="password" placeholder="Enter a strong password">
        <input type="submit" name="login" value="LOGIN"></input>
    </form>
    <?php
    if (!isset($_SESSION['just_registered'])) {
        ?>
        <p> Don't have an account yet? CLick <a href="register.php">here</a> to register.</p>
    <?php
    } 
    ?>
    <p>Forgotten your password? CLick <a href="reset.php">here</a> to reset your password</p>
</center>
</body>
</html>
