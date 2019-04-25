<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CafeMovil</title>
	</head>
	<body>
	<center>
		<h1>Iniciar sesion</h1>
		<form action = "#" method = "post">
			@csrf
			Correo: <br>
			<input type="email" placeholder="Correo" name = "email" required> <br> <br>
			Contraseña: <br>
			<input type="password" placeholder="Contraseña" name = "password" required> <br> <br>
			<input type="submit" value="Iniciar sesión">
		</form>
	</center>
	</body>
</html>