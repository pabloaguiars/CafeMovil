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
		<?php	
			$con = mysqli_connect("host","username","password","db") or die("Problemas con la conexion a la base de datos");
			$comidas = mysqli_query($con, "select no_control from Comidas" or die(mysqli_error($con));
			$listo = false;
			$num1 = rand(0,9);
			$num2 = rand(0,9);
			$num3 = rand(0,9);
			$no_control = $num1 . $num2 . $num3;
			if(empty($comidas)){
				$listo = true;
			} else {
				while($comida = mysqli_fetch_array($comidas) {
					if($comida['no_control'] == $no_control) {
						$listo = false;
						$num1 = rand(0,9);
						$num2 = rand(0,9);
						$num3 = rand(0,9);
						$numero_control = $num1."".$num2."".$num3;
						$comidas = mysqli_query($con, "select no_control from Comidas" or die(mysqli_error($con));
					}
					else{
						$listo = true;
					}
				}
			}
			
			if($listo == true) {	?>
				<form action = "altaNuevoAlimento2.php" method = "post" enctype="multipart/form-data">
				<h2> SUBIR UN NUEVO ALIMENTO A LA BASE DE DATOS	</h2>
				Numero de control asignado: <?php echo $no_control;	?> <br> <br>
				Ingresa nombre: <input type = "text" name = "nombre" required> <br> <br>
				Ingrese el precio: <input type = "text" name = "precio" required> <br> <br>
				Ingrese la ganancia: <input type = "text" name = "ganancia" required> <br> <br>
				Ingrese una descripción: <input type = "text" name = "precio" size = "250" required> <br> <br>
				Suba la foto del alimento: <input type "file" name = "foto"> <br> <br>
				<input type = "hidden" name = "no_control" value = "<?php $no_control; ?>">
				<input type = "submit" value = "LISTO">
	  <?php	} else {
				echo "Problemas al asignar un numero de control. Consulte al Administrador.";
			}
			
		mysqli_close($con);
		?>
	</body>
</html>
<?php 				
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>