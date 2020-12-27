<?php 

session_start();
if(empty($_SESSION['active']))
{
    header('location: ../cliente.php');
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
    <title>Datos Personales</title>
</head>
<body>
    <h1>Datos personales</h1>
    <table>
        <tr>
            <th>DNI</th>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Action</th>
        </tr>
            <?php 
            $conexion = mysqli_connect(
                'localhost:8080',
                'root',
                'andre123') or die ("problemas en la conexion");
            mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
            $dni=$_SESSION['DNI'];
            $consulta="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,
            pt.telefono
            from persona p
            inner join persona_correo_electronico pce
            on p.DNI=pce.DNI_persona
            inner join persona_telefono pt
            on p.DNI=pt.DNI_persona
            inner join usuario u
            on p.DNI=u.DNI
            where p.DNI=$dni
            group by p.DNI;";
            $query=mysqli_query($conexion,$consulta) or die("error");
            while($data=mysqli_fetch_array($query))
            {
                $DNI=$data['DNI'];
                $nombres=$data['nombres'];
                $primero_apellido=$data['primero_apellido'];
                $segundo_apellido=$data['segundo_apellido'];
                $correo_electronico=$data['correo_electronico'];
                $contraseña=$data['contraseña'];
                $telefono=$data['telefono'];
            
            ?>
            <tr>
                <td><?php echo $data['DNI']?></td>
                <td><?php echo $data['nombres']?></td>
                <td><?php echo $data['primero_apellido']?></td>
                <td><?php echo $data['segundo_apellido']?></td>
                <td><?php echo $data['contraseña']?></td>
                <td><?php echo $data['correo_electronico']?></td>
                <td><?php echo $data['telefono']?></td>
                <td>
                <a href="./actualizardatos.php?DNI=<?php echo $DNI;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

                </td>
            </tr>

        <?php } ?>
    </table>
</body>
</html>