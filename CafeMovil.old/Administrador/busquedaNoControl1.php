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
	<body>
		<form action = "busquedaNoControl2.php" method = "post">
			<h3> Busqueda por No. de control <h3>
			Ingrese No. de control: <input type = "text" name = "noControl"> <br> <br>
			<input type = "hidden" name = "tipoBusqueda" value = "<?php $_REQUEST['v']; ?>">
			<input type = "submit" value = "LISTO">
		</form>
	</body>
</html>
<?php 				
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>