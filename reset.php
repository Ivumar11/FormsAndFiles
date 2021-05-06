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
if (isset($_SESSION['msg'])) {
    echo "<h3>".$_SESSION['msg']."</h3>";
}?>
    
    <h3>Reset Password</h3>
    <form action="processor.php" method="POST">
        <input type="text" name="u_name" placeholder="Username">
        <input type="password" name="new_password" placeholder="New password">
        <input type="password" name="confirm_password" placeholder="Confirm password">
        <input type="submit" name="reset" value="RESET"></input>
    </form>
    
    <?php unset($_SESSION['msg']); ?>
    <p>Can't remember your username? <a href="reset.php">CLick here</a> to create a new account</p>
    </center>
</body>
</html>