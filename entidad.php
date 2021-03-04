<?php 
	include_once 'conexion.php';


	$sentencia_select=$con->prepare('SELECT *FROM empresas ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('SELECT *FROM empresas WHERE nombre LIKE :campo OR sitiow LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?> 

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CRUD de Datos</title>
	<link rel="stylesheet" href="css/estilo.css">


	<li><h1><a href="index.php">EMPLEADOS</a></h1></li>
							

</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ---EL CHAPO S.A--- </h2>
		<h2> ---EMPRESAS--- </h2>
		
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Busqueda Nombre/Sitio Web" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insertarE.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id Empresa</td>
				<td>Nombre</td>
				<td>Sitio Web</td>
				<td>Dirección</td>
				<td>Correo</td>
				
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['sitiow']; ?></td>
					<td><?php echo $fila['direccion']; ?></td>
					<td><?php echo $fila['correo']; ?></td>

				<td><a href="editarE.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="eliminarE.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>