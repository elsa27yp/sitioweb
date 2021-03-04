<?php 
	include_once 'conexion.php';


	$sentencia_select=$con->prepare('SELECT *FROM empleados ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];

		$select_buscar=$con->prepare('SELECT *FROM empleados WHERE nombre LIKE :campo OR nempresa LIKE :campo;'
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
<button class="btn btn-success btn-lg"><i class="fa fa-file"></i><center>REPORTES EL CHAPO S.A</center></button>
							</a>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>EL CHAPO S.A</title>
	<link rel="stylesheet" href="css/estilo.css">

	<li><h1><a href="entidad.php">EMPRESAS</a></h1></li>
							

</head>
<body>
	<div class="contenedor">
		<h2> ---BUSQUEDA RÁPIDA--- </h2>
		
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Ingrese Nombre Empresa" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Nombre Empresa</td>
				

				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['nempresa']; ?></td>
					
					<td><a href="editarreporte.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="eliminarreporte.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>