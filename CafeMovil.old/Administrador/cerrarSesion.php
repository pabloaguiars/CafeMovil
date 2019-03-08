<?php
	session_start();
	if(isset($_SESSION['correo']))
	{
		session_unset();
		session_destroy();
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
		exit(0);
	}
	else
	{
		header("Location: http://www.cafeteria58.esy.es/loginAdmin.html");
	}
?>