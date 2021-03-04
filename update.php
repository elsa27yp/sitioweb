<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM empleados WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$telefono=$_POST['telefono'];
		$nempresa=$_POST['nempresa'];
		$correo=$_POST['correo'];
		$idEmpresa=$_POST['idEmpresa'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($nempresa) && !empty($correo) && !empty($idEmpresa) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE empleados SET  
					nombre=:nombre,
					apellidos=:apellidos,
					telefono=:telefono,
					nempresa=:nempresa,
					correo=:correo,
					idEmpresa=:idEmpresa
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':telefono' =>$telefono,
					':nempresa' =>$nempresa,
					':correo' =>$correo,
					':idEmpresa' =>$idEmpresa,
					':id' =>$id
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
	<title>Editar Empleado</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ----CACAO.GT---- </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="apellidos" value="<?php if($resultado) echo $resultado['apellidos']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
				<input type="text" name="nempresa" value="<?php if($resultado) echo $resultado['nempresa']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="idEmpresa" value="<?php if($resultado) echo $resultado['idEmpresa']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
