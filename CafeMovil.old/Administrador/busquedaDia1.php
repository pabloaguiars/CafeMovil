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
		<form action = "busquedaPrecioCosto2.php" method = "post">
			<h3> Busqueda por Día de comprar del Mes <h3>
			Seleccione el día: <select name = "dia">
			<?php 
				$contador = 1;
				while($contador <= 31)
				{
					echo '<option value=\"$contador\">$contador</option>';
					$contador = $contador + 1;
				}
			?>
			</select><br> <br>
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