<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$sitiow=$_POST['sitiow'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];

		if(!empty($nombre) && !empty($sitiow) && !empty($direccion) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO empresas(nombre,sitiow,direccion,correo) VALUES(:nombre,:sitiow,:direccion,:correo)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':sitiow' =>$sitiow,
					':direccion' =>$direccion,
					':correo' =>$correo
				));
				header('Location: entidad.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nueva Empresa</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ----CACAO.GT---- </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre Empresa" class="input__text">
				<input type="text" name="sitiow" placeholder="Sitio Web" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="direccion" placeholder="Dirección" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" placeholder="Correo electrónico" class="input__text">
			</div>
			<div class="btn__group">
				<a href="entidad.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
