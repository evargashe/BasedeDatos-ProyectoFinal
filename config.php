<?php
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
?>
