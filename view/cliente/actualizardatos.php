<?php 

session_start();
if(!empty($_SESSION['active']))
{
    header('location: ../cliente.php');
}
?>
<?php 
$message="";
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");


$DNI=$_SESSION['DNI'];
$sql="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,u.presupuesto,
        pt.telefono
        from persona p
        inner join persona_correo_electronico pce
        on p.DNI=pce.DNI_persona
        inner join persona_telefono pt
        on p.DNI=pt.DNI_persona
        inner join usuario u
        on p.DNI=u.DNI
        where p.DNI='$DNI'
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
    $presupuesto=$row['presupuesto'];
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
    
    <form method="post" action="controler/actualizarindex.php">
        <div class="col-md-6">
            <label>DNI</label>
            <input type="number" id="DNI" name="DNI" class="form-control"  required value="<?php echo $DNI;?>"> 
        </div>
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" required value="<?php echo $nombres;?>">
        </div>
        <div class="col-md-6">
            <label >Primer apellido</label>
            <input type="text" id="primero_apellido"name="primer_apellido" class="form-control" required value="<?php echo $primero_apellido;?>">
        </div>
        <div class="col-md-6">
            <label>Segundo Apellido</label>
            <input type="text" id="segundo_apellido"name="segundo_apellido" class="form-control" required value="<?php echo $segundo_apellido;?>"> 
        </div>
        <div class="col-md-6">
            <label>Contraseña</label>
            <input type="password" id="contraseña"name="contraseña" class="form-control" required >
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" id="correo_electronico"name="correo_electronico" class="form-control" required value="<?php echo $correo_electronico;?>">
        </div>
        <div class="col-md-6">
            <label>Telefono</label>
            <input type="number" id="telefono"name="telefono" class="form-control" required value="<?php echo $telefono;?>">
        </div>
        <div class="col-md-6">
            <label>Presupuesto</label>
            <input type="number" id="presupuesto"name="presupuesto" class="form-control" required value="<?php echo $presupuesto;?>">
        </div>
        <button type="button" class="btn btn-success">Actualizar</button>
    </form>
</div>
</body>
</html>