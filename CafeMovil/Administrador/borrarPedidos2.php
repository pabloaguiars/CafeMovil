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
			$con = mysqli_connect("host","username","password","db") or die("Problemas con la conexion a la base de datos.");
			$registros = mysqli_query($con, "select * from Administrador") or die(mysqli_error($con));
			while($reg = mysqli_fetch_array($registros))
			{
				if($reg['Usuario'] == $_REQUEST['usuario1'])
				{
					if($reg['Clave'] == $_REQUEST['contrasena1'])
					{
						$registros = mysqli_query($con, "select * from Administrador") or die(mysqli_error($con));
						while($reg = mysqli_fetch_array($registros))
						{
							if($reg['Usuario'] == $_REQUEST['usuario2'])
							{
								if($reg['Clave'] == $_REQUEST['contrasena2'])
								{
									mysqli_query($con, "delete * from Administrador") or die(mysqli_error($con));
									echo "La tabla de pedidos ha quedado limpia."
								}
							}
						}
					}
				}
			}
			mysqli_close($con);
			header("Location: www.cafeteria58.esy.es/Administrador/index Admin.php");
			exit(0);
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