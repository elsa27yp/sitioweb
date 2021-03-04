<?php
include('conexion.php');
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;


$conexion=mysqli_connect("localhost","root","","registro");

$consulta="SELECT*FROM usuarios where usuario='$usuario' and contra='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:index.php");

}else{
    ?>
    <?php
    include("index.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
