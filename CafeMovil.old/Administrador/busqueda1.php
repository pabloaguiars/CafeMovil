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
		<form action = "busqueda2.php" method = "post">
			Busqueda en tabla: <br> <br>
			<input type = "radio" name = "radio1" value = "1"> Usuarios <br>
			<input type = "radio" name = "radio1" value = "2"> Comidas <br>
			<input type = "radio" name = "radio1" value = "3"> Pedidos <br> 	<br>
			
			
			
			Ubicar por: <select name = "busqueda">
			<option value = "1">No. Control </option>
			<option value = "2">Día de compra </option>
			<option value = "3">Precio/Pago </option>
			</select> <br> <br>
			
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