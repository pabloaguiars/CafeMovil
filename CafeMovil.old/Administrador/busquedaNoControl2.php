<?php
	session_start();
	if(isset($_SESSION['no_control']))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equitipoBusqueda="Content-Type" content="text/html; charset=UTF-8" />
		<title>CafeMótipoBusquedail</title>
		<!-- <link rel="stylesheet" href="css/style.css"> -->
	</head>
	<body>
		<?php
			$si=false;
				$con = mysqli_connect("mysql.hostinger.mx",
				"u664546622_admin","pinocho8.","u664546622_cafe")
				or die("Problemas con la conexion a la base de datos");
				
			if($_REQUEST['tipoBusqueda'] == 1)
			{
				// Busqueda tabla usuarios por numero de control

				$registros=mysqli_query($con,"select no_control,nombre, apellidos, nombre_usuario, contrasena
                        	from usuarios where no_control='$_REQUEST[noControl]'") or
  				die("Problemas en el select:".mysqli_error($conexion));

				if ($reg=mysqli_fetch_array($registros))
				{
				 echo "No. Control:".$reg['no_control']."<br>";					
 				 echo "Nombre:".$reg['nombre'].$reg['apellidos']."<br>";
 				 echo "Nombre de usuario:".$reg['nombre_usuario']."<br>";
				 echo "Contraseña:".$reg['contrasena']."<br>";
				
				}
				else
				{
				  echo "No existe un usuario con ese No. de Control.";
				}

			} 
			elseif($_REQUEST['tipoBusqueda'] == 2)
			{
				// Busqueda tabla comidas por numero de control
				$registros=mysqli_query($con,"select no_control, nombre, precio, ganancia, descripcion
                        	from Comidas where no_control='$_REQUEST[noControl]'") or
  				die("Problemas en el select:".mysqli_error($conexion));

				if ($reg=mysqli_fetch_array($registros))
				{
				echo "No. Control:".$reg['no_control']."<br>";	
 				 echo "Nombre:".$reg['nombre']."<br>";
 				 echo "Precio:".$reg['precio']."<br>";
				 echo "Ganancia:".$reg['ganancia']."<br>";
				echo "Descripción:".$reg['descripcion']."<br>";	
				
				}
				else
				{
				  echo "No existe un usuario con ese No. de Control.";
				}
				
			}
			elseif($_REQUEST['tipoBusqueda'] == 3)
			{
				// Busqueda tabla pedidos por numero de control
						$registros = mysqli_query($con, "select ped.no_pedido, ped.dia, ped.mes, ped.hora_entrega, usu.no_control, usu.nombre as cliente, usu.apellidos, com.nombre as comida, com.precio from Pedidos as ped inner join usuarios as usu on usu.no_control = ped.no_cliente inner join Comidas as com on com.no_control = ped.no_comida") or die(mysqli_error($con));
				
				while ($reg=mysqli_fetch_array($registros))
					{
						if($reg['no_pedido'] == $_REQUEST['noControl'])
						{
						$si = true;
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
					}
					if($si == false)
					{
						echo "No se tienen pedidos registrados con dicho No. de Control.";
					}
	
				
			
			}
			else
			{
				mysqli_close($con);
				header("Location www.cafeteria58.esy.es/ARCHIVOS/Administrador/busqueda1.php");
				exit(0);
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