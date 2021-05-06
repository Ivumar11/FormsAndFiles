<?php include("auth_session.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Practising files and forms</title>
</head>
<body>
<center>
<h2> Welcome, <?php echo $_SESSION['username'] ?></h2><br><br>
<button style="padding: 10px; background: blue;">
<a href="logout.php" style="color: white; text-decoration: none;">LOGOUT</a>
</button>
</center>
</body>
</head>
</html>