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
		header('Location: busqueda.php');
	}
	


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$nempresa=$_POST['nempresa'];
		$id=(int) $_GET['id'];
  
  echo $_POST['nempresa'];

		if(empty($nombre) && empty($nempresa) ){
			echo "<script> alert('Los campos estan vacios');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE empleados SET  
					nombre=:nombre,
					nempresa=:nempresa
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':nempresa' =>$nempresa,
					':id' =>$id
				));
				header('Location: busqueda.php');
			}
		}else{
			
		}
	

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2> ----EL CHAPO S.A---- </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				
			</div>
			<div class="form-group">
				
				<input type="text" name="nempresa" value="<?php if($resultado) echo $resultado['nempresa']; ?>" class="input__text">
			</div>
			
			
			<div class="btn__group">
				<a href="busqueda.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
