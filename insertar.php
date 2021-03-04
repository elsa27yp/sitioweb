<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$telefono=$_POST['telefono'];
		$nempresa=$_POST['nempresa'];
		$correo=$_POST['correo'];
		$idEmpresa=$_POST['idEmpresa'];

		if(!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($nempresa) && !empty($correo) && !empty($idEmpresa) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO empleados(nombre,apellidos,telefono,nempresa,correo, idEmpresa) VALUES(:nombre,:apellidos,:telefono,:nempresa,:correo, :idEmpresa)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':telefono' =>$telefono,
					':nempresa' =>$nempresa,
					':correo' =>$correo,
					':idEmpresa' =>$idEmpresa
				));
				header('Location: index.php');
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
	<title>Nuevo Empleado</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ----CACAO.GT---- </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="apellidos" placeholder="Apellidos" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Teléfono" class="input__text">
				<input type="text" name="nempresa" placeholder="Nombre Empresa" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" placeholder="Correo electrónico" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="idEmpresa" placeholder="Cod Empresa" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
