<?php 

session_start();
$DNI=$_GET['DNI'];
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

    if(!empty($_POST)){
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
<?php 
/* $message="";
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

if(!empty($_POST)){
    $DNI= $_POST['DNI'];
    $nombres= $_POST['nombres'];
    $primero_apellido= $_POST['primero_apellido'];
    $segundo_apellido= $_POST['segundo_apellido'];
    $contraseña= $_POST['contraseña'];
    $correo_electronico= $_POST['correo_electronico'];
    $telefono= $_POST['telefono'];
    $presupuesto= $_POST['presupuesto'];


    $sql_update=mysqli_query($conexion,"update persona p set p.contraseña=$contraseña,p.nombres=$nombres,p.primero_apellido=$primero_apellido,
    p.segundo_apellido=$segundo_apellido where p.DNI=$DNI;
    update persona_correo_electronico pce set pce.correo_electronico=$correo_electronico
    where pce.DNI_persona=$DNI;
    update persona_telefono pt set pt.telefono=$telefono where pt.DNI_persona=$DNI;
    update usuario u set u.presupuesto=$presupuesto where u.DNI=$DNI;") or die ("error2");
        
    if($sql_update)
    {
        $message="datos insertados";
        $class="alert alert-success";

    }
    else{
        $message="no se pudo";  
        $class="alert alert-danger";

    }


} */

$sql="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,u.presuspuesto,
        pt.telefono
        from persona p
        inner join persona_correo_electronico pce
        on p.DNI=pce.DNI_persona
        inner join persona_telefono pt
        on p.DNI=pt.DNI_persona
        inner join usuario u
        on p.DNI=u.DNI
        where p.DNI=$DNI
        group by p.DNI;";

$row2=mysqli_query($conexion,$sql) or die("error3");
while($row=mysqli_fetch_array($row2))
{
    $DNI=$row['DNI'];
    $nombres=$row['nombres'];
    $primero_apellido=$row['primero_apellido'];
    $segundo_apellido=$row['segundo_apellido'];
    $correo_electronico=$row['correo_electronico'];
    $contraseña=$row['contraseña'];
    $telefono=$row['telefono'];
    $presuspuesto=$row['presuspuesto'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Actualizar</title>
</head>
<body>

<div class="container">
    <div>
        <a href="./datoscliente.php" >Salir</a>
    </div>
    <form method="POST">
        <div class="col-md-6">
            <label>DNI</label>
            <input type="integer" id="DNI" name="DNI" class="form-control"  value="<?php echo $DNI;?>"> 
        </div>
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $nombres;?>">
        </div>
        <div class="col-md-6">
            <label >Primer apellido</label>
            <input type="text" id="primero_apellido"name="primero_apellido" class="form-control"value="<?php echo $primero_apellido;?>">
        </div>
        <div class="col-md-6">
            <label>Segundo Apellido</label>
            <input type="text" id="segundo_apellido"name="segundo_apellido" class="form-control"value="<?php echo $segundo_apellido;?>"> 
        </div>
        <div class="col-md-6">
            <label>Contraseña</label>
            <input type="password" id="contraseña"name="contraseña" class="form-control" >
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" id="correo_electronico"name="correo_electronico" class="form-control" value="<?php echo $correo_electronico;?>">
        </div>
        <div class="col-md-6">
            <label>Telefono</label>
            <input type="integer" id="telefono"name="telefono" class="form-control" value="<?php echo $telefono?>">
        </div>
        <div class="col-md-6">
            <label>Presupuesto</label>
            <input type="integer" id="presuspuesto"name="presuspuesto" class="form-control" value="<?php echo $presuspuesto;?>">
        </div>
        <button type="button" class="btn btn-success">Actualizar</button>
    </form>
    
</body>
</html>