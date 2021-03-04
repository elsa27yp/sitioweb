<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM empresas WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: entidad.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$sitiow=$_POST['sitiow'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($sitiow) && !empty($direccion) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE empresas SET  
					nombre=:nombre,
					sitiow=:sitiow,
					direccion=:direccion,
					correo=:correo
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':sitiow' =>$sitiow,
					':direccion' =>$direccion,
					':correo' =>$correo,
					':id' =>$id
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
	<title>Editar Empresa</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ----EL CHAPO S.A---- </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="sitiow" value="<?php if($resultado) echo $resultado['sitiow']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado['direccion']; ?>" class="input__text">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			</div>
			<div class="form-group">
				
			</div>
			<div class="btn__group">
				<a href="entidad.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>

