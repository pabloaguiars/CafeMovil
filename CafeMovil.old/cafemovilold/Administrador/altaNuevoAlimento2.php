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
			function isImage($path)
			{
			$imageSizeArray = getimagesize($path);
			$imageTypeArray = $imageSizeArray[2];

				return (bool)(in_array($imageTypeArray , array(IMAGETYPE_JPEG)));
			}
			
			$con = mysqli_connect("host","username","password","db") or die("Problemas con la conexion a la base de datos");
			$newname = $_REQUEST['no_control'];
			
			copy($_FILES['foto']['tmp_name'],$_FILES['foto']['name']);
			echo "La foto se registro en el servidor.<br>";
			rename("/".$_FILES['foto']['name'].".jpg", "/".$newname.".jpg");
			
			if(isImage('/'.$newname.'.jpg'))
			{
				if(copy('/'.$newname.'.jpg', 'www.cafeteria58.esy.es/ImagesComidas/'.$newname.'.jpg')
				{
					unlink('/'.$newname.'.jpg');
					echo "La foto se registro en el servidor.<br>";
					$nombreComida = strtoupper($_REQUEST['nombre']);
					$descripcion = strtoupper($_REQUEST['descripcion']);
					mysqli_query($con, "insert into Comidas(no_control, nombre, precio, ganancia, descripcion) value($newname,'$nombreComida',$_REQUEST[precio]),$_REQUEST[ganancia],'$descripcion')") or die(mysqli_error($con));
					
				} else {
					echo "Algo salioó mal de último momento. La imagen no se movió al directorio final.";
				}
			}
			else{
				//alguien está siendo malo
				unlink('/'.$newname.'.jpg');
				echo "No se ingresó una imagen en formato .jpg o .jpeg";
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