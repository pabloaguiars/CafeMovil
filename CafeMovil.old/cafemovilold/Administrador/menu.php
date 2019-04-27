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
		<center> <h3> Menú opciones: </h3> </center>
		- <A HREF="listadoVentas.php" TARGET="central">Listado de pedidos</A> <br>
		- <A HREF="busqueda1.php" TARGET="central">Busquedas</A> <br>
		- <A HREF="borrarPedidos1.php" TARGET="central">Eliminar pedidos del MES</A> <br>
		- <A HREF="altaNuevoAlimento1.php" TARGET="central">Nuevo alimento al menú</A> <br> <br>
		- <A HREF="cerrarSesion.php" TARGET="central">CERRAR SESIÓN</A> <br>  
	</body>
</html>
<?php 				
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>