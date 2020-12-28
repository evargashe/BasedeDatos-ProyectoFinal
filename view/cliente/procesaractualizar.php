
<?php 
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

if(($_SERVER['REQUEST_METHOD']=='POST')){

    $DNI=$_POST['DNI'];
    $nombres=$_POST['nombres'];
    $primero_apellido=$_POST['primero_apellido'];
    $segundo_apellido=$_POST['segundo_apellido'];
    $correo_electronico=$_POST['correo_electronico'];
    $contraseña=$_POST['contraseña'];
    $telefono=$_POST['telefono'];
    $presuspuesto=$_POST['presuspuesto'];

    $sql_update=mysqli_query($conexion,"update persona set contraseña=$contraseña,nombres=$nombres,primero_apellido=$primero_apellido,
        segundo_apellido=$segundo_apellido where DNI=$DNI") or die ("error2");
    $sql_update1=mysqli_query($conexion,"update persona_correo_electronico set correo_electronico=$correo_electronico
    where DNI_persona=$DNI;");

    $sql_update2=mysqli_query($conexion,"update persona_telefono set telefono=$telefono where DNI_persona=$DNI;
    ");

    $sql_update3=mysqli_query($conexion,"update usuario set presupuesto=$presuspuesto where DNI=$DNI");



    if($sql_update && $sql_update1 && $sql_update2 && $sql_update3)
    {
        echo "se a modificado los datos";
    }
    else{
        echo "no se pudo modificar";
}
}

?>
