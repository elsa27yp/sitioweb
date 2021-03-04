<?php 
	include_once 'conexion.php';


	$sentencia_select=$con->prepare('SELECT *FROM empleados ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();



	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('SELECT *FROM empleados WHERE nombre LIKE :campo OR apellidos LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>
<!--LINK PARA REDIRECCIONAR REPORTES -->
 <a href="http://localhost/reportechapo/BD/index.php" target="_blank">
 	<br>
<button class="btn btn__reportegeneral"><center>REPORTE GENERAL</center></button>
							</a>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>EL CHAPO S.A</title>
	<link rel="stylesheet" href="css/estilo.css">

	<h3><a href="entidad.php">EMPRESAS</a></h3>
	<h3><a href="busqueda.php" class="btn btn__reporte">REPORTE - BR- </a></h3>
							

</head>
<body>
	<div class="contenedor">
		<h2>CRUD DE DATOS ---EL CHAPO S.A--- </h2>
		<h2> ---EMPLEADOS--- </h2>
		
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o apellidos" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insertar.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>Teléfono</td>
				<td>Nombre Empresa</td>
				<td>Correo</td>
				<td>Cod Empresa</td>

				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['nempresa']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['idEmpresa']; ?></td>

					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>