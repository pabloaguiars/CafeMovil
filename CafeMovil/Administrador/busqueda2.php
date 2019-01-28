<?php
	session_start();
	if(isset($_SESSION['no_control']))
	{
?>
<!DOCTYPE php>
<php>
	<head>
		<meta http-equiv="Content-Type" content="text/php; charset=UTF-8" />
		<title>CafeMóvil</title>
		<!-- <link rel="stylesheet" href="css/style.css"> -->
	</head>
	<body>
		<?php
			if($_REQUEST['radio1'] == 1 and $_REQUEST['busqueda'] == 1)
			{
				header("Location: /busquedaNoControl.php?v=1");
				exit(0);
			} 
			elseif($_REQUEST['radio1'] == 2 and $_REQUEST['busqueda'] == 1)
			{
				header("Location: /busquedaNoControl.php?v=2");
				exit(0);
			}
			elseif($_REQUEST['radio1'] == 2 and $_REQUEST['busqueda'] == 3)
			{
				header("Location: /busquedaPrecioCostol.php?v=1");
				exit(0);
			}
			elseif($_REQUEST['radio1'] == 3 and $_REQUEST['busqueda'] == 1)
			{
				header("Location: /busquedaNoControl.php?v=1");
				exit(0);
			}
			elseif($_REQUEST['radio1'] == 3 and $_REQUEST['busqueda'] == 2)
			{
				header("Location: /busquedaDia1.php");
				exit(0);
			}
			elseif($_REQUEST['radio1'] == 3 and $_REQUEST['busqueda'] == 3)
			{
				header("Location: /busquedaPrecioCosto1.php?v=2");
				exit(0);
			}
			else
			{
				echo "Convinación de valores de busqueda erronea.";
				exit(0);
			}
		?>
	</body>
<?php 				
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>