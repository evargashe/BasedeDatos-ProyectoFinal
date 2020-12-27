
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
<?php 
$message="";
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

if(!empty($_POST)){
    if(empty($_POST['nombres']) || empty($_POST['correo_electronico']))
    {
        echo "El campo nombre o correo deben ser llenados obligatoriamente";
    }
    else{
        $DNI= $_POST['DNI'];
        $nombres= $_POST['nombres'];
        $primero_apellido= $_POST['primero_apellido'];
        $segundo_apellido= $_POST['segundo_apellido'];
        $contraseña= $_POST['contraseña'];
        $correo_electronico= $_POST['correo_electronico'];
        $telefono= $_POST['telefono'];
        $query="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,
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
        $result=mysqli_query($conexion,$query);
        $result1=mysqli_fetch_array($result);
        if($result1>0)
        {
            $message="el correo o nombre ya existe";
        }
        else{
            if(empty($_POST['contraseña']))
            {
                $sql_update=mysqli_query($conexion,"update persona set DNI=$DNI,nombres=$nombres,primero_apellido=$primero_apellido,
                segundo_apellido=$segundo_apellido where DNI=$DNI;
                update persona_correo_electronico set DNI_persona=$DNI,correo_electronico=$correo_electronico
                where DNI_persona=$DNI;
                update persona_telefono set DNI=$DNI,telefono=$telefono where DNI_persona=$DNI;
                update usuario set DNI=$DNI where DNI=$DNI;") or die ("error");
            }
            else{
                $sql_update=mysqli_query($conexion,"update persona p set p.DNI=$DNI,p.contraseña=$contraseña,p.nombres=$nombres,p.primero_apellido=$primero_apellido,
                p.segundo_apellido=$segundo_apellido where p.DNI=$DNI;
                update persona_correo_electronico pce set pce.DNI_persona=$DNI,pce.correo_electronico=$correo_electronico
                where pce.DNI_persona=$DNI;
                update persona_telefono pt set pt.DNI=$DNI,pt.telefono=$telefono where pt.DNI_persona=$DNI;
                update usuario u set u.DNI=$DNI where u.DNI=$DNI;") or die ("error");
            }
            if($sql_update)
            {
                $message="datos insertados";
            }
            else{
                $message="no se pudo";  
            }
        }

    }
}

$DNI=$_GET['DNI'];

$sql="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,
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

$row2=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_array($row2))
{
    $DNI=$row['DNI'];
    $nombres=$row['nombres'];
    $primero_apellido=$row['primero_apellido'];
    $segundo_apellido=$row['segundo_apellido'];
    $correo_electronico=$row['correo_electronico'];
    $contraseña=$row['contraseña'];
    $telefono=$row['telefono'];
} 
?>
<div class="<?php echo $class?>">
				 
				</div>
<div class="container">
    
    <form method="post">
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
        <button type="button" class="btn btn-success">Actualizar</button>
    </form>
</div>
</body>
</html>