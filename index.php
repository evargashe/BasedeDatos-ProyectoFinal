<?php
require_once('config.php');

$conexion = mysqli_connect('localhost:8080','root','andre123','bicicleta');
$consulta= "SELECT * FROM producto";
$resultado = mysqli_query($conexion,$consulta);
while($row=mysqli_fetch_array($resultado))
{
  echo "id_producto: ".$row['id_producto'];
  echo "precio: ".$row['precio'];
}
?>
