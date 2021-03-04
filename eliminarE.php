<?php 

	include_once 'conexion.php';
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$con->prepare('DELETE FROM empresas WHERE id=:id');
		$delete->execute(array(
			':id'=>$id
		));
		header('Location: entidad.php');
	}else{
		header('Location: entidad.php');
	}
 ?>