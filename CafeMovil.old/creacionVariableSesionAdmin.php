<?php
	session_start();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title> </title>
	</head>
	<body>
	<?php
		$con = mysqli_connect("host","username","password","db") or die("Problemas con la conexion a la base de datos.");
		$con1 = mysqli_connect(
		$registros = mysqli_query($con, "select * from Administrador") or die(mysqli_error($con));
		while($reg = mysqli_fetch_array($registros))
		{
			if($reg['Usuario'] == $_REQUEST['usuario'])
			{
				if($reg['Clave'] == $_REQUEST['contrasena'])
				{
					$_SESSION['no_control'] = $reg['No_Control'];
					header("Location: /ARCHIVOS/Administrador/indexAdmin.php");
					exit(0);
				}
			}
		}
	?>
	<br>
	<hr>
	Página principal
	<a href = "http://www.cafeteria58.esy.es/loginAdmin.html"> 
		Clic aqui
	</a>
	</body>
</html> 