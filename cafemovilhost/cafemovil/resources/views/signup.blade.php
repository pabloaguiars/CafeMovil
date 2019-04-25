<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CafeMovil</title>
	</head>
	<body>
		<center>
			<h1>Registrarse</h1>
			<form action = "/estudiantes" method = "post">
				@csrf
				Nombre: 
				<input type="text" placeholder="" name = "name" required> <br> <br>
				Apellido paterno: 
				<input type="text" placeholder="" name = "father_last_name" required> <br> <br>
				Apellido materno: 
				<input type="text" placeholder="" name = "mother_last_name" required> <br> <br>
				CURP: 
				<input type="text" placeholder="" name = "curp" maxlength="18" required> <br> <br>
				Teléfono personal: 
				<input type="tel" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="10" required> <br> <br>
				Correo: 
				<input type="email" placeholder="" name = "email" required> <br> <br>
				Contraseña: 
				<input type="password" placeholder="" name = "password" required> <br> <br>
				Foto de perfil: 
				<input type="file" name="image"> <br> <br>
				Escuela: 
				<select name="school" required>

					@foreach ($schools as $school)
						<option value="{{$school->id}}">{{$school->name}}</option>';
					@endforeach

				</select> <br> <br>
				Número de control: 
				<input type="text" placeholder="" name = "id_at_school" required> <br> <br>
				<input type="submit" value="Registrarme">
			</form>
		</center>
	</body>
</html>