<?php
	session_start();
	if(isset($_SESSION['no_control']))
	{
		$hoy = getdate();
		echo $hoy['mday'];
		echo $hoy['seconds'];
		echo $hoy['hours'];
		echo $hoy['minutes'];
		if($hoy['mday'] == 1)
		{ ?>
			<!DOCTYPE html>
			<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>CafeMóvil</title>
					<!-- <link rel="stylesheet" href="css/style.css"> -->
				</head>
				<body>
					<form action = "borrarPedidos2.php" method = "post">
						<h3> ELIMINAR TODAS LAS VENTAS DEL MES <h3>
						Ingrese usuario y cntraseña del Admin1:
						<input placeholder="Usuario" name = "usuario1"/> <br> <br>
						<input type="password" placeholder="Password"name = "contrasena1"> <br> <br>
						
						Ingrese usuario y cntraseña del Admin2:
						<input placeholder="Usuario" name = "usuario2"/> <br> <br>
						<input type="password" placeholder="Password"name = "contrasena2"> <br> <br>
						
						<input type = "submit" value = "LISTO">
					</form>
				</body>
			</html>
<?php	}
		else
		{
			echo "La limpieza de pedidos se efectúa el primer día de cada mes.";
		}
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>