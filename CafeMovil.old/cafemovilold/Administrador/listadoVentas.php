<?php
	session_start();
	if(isset($_SESSION['no_control']))
	{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>CafeMóvil</title>
		<!-- <link rel="stylesheet" href="css/style.css"> -->
	</head>
	<body>
		<?php
		error_reporting(0);
		$con = mysqli_connect("host","username","password","db") or die("Problemas con la conexion a la base de datos");
		$listo = false;
		$registros = mysqli_query($con, "select ped.no_pedido, ped.dia, ped.mes, ped.hora_entrega, usu.no_control, usu.nombre as cliente, usu.apellidos, com.nombre as comida, com.precio from Pedidos as ped inner join usuarios as usu on usu.no_control = ped.no_cliente inner join Comidas as com on com.no_control = ped.no_comida") or die(mysqli_error($con));
		if(empty($registros))
		{
			echo "<h1> No se encontraron pedidos en la base la base de datos. </h1>";
		}
		else
		{
			echo "<table border = 1>";
			echo '<tr> <td align = "center"> <h3> Pedidos del Mes </h3> </td> </tr>';
			echo "<tr> <td>";
			while($pedido = mysqli_fetch_array($registros))
			{
				$listo = True;
				echo "No. de Pedido: ".$pedido['no_pedido'];
				echo "<br>";
				echo "Cliente: ".$pedido['no_control'];
				echo "<br>";
				echo "Nombre: ".$pedido['usuario']." ".$pedido['apellidos'];
				echo "<br>";
				echo "Datos del pedido:";
				echo "<br>";
				echo "<br>";
				echo "Fecha y hora: ".$pedido['dia']." / ".$pedido['mes']." ; "." Hora: ".$pedido['hora_entrega']."hrs";
				echo "<br>";
				echo "Comida: ".$pedido['comida'];
				echo "<br>";
				echo "Precio individual: ".$pedido['precio'];
				echo "Cantidad: 1";
				echo "<br";
				echo "Neto a pagar: ".$pedido['precio'];
				echo "<br>";
				echo "<br>";
				echo "<hr>";
			}
			if($listo == false)
			{
				echo "<br>";
				echo "No se encontraron ventas.";
			}
			echo "</tr> </td>";
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