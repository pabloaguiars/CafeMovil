<?php
	session_start();
	if(isset($_SESSION['no_control']))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>CafeMóvil</title>
		<!-- <link rel="stylesheet" href="css/style.css"> -->
	</head>
	<frameset rows="15%,*">
	<frame name="titulo" src="titulo.php">
		<frameset cols="20%,*"> 
			<frame name="menu" src="menu.php">
			<frame name="central" src="central.php">
		</frameset> 
	</frameset>
</html>
<?php 				
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>