
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
    <title>Document</title>
</head>
<body>
    <?php 
    if(!empty($_POST)){
        $DNI= $_POST['DNI'];
        $nombres= $_POST['nombres'];
        $primero_apellido= $_POST['primero_apellido'];
        $segundo_apellido= $_POST['segundo_apellido'];
        $contraseña= $_POST['contraseña'];
        $correo_electronico= $_POST['correo_electronico'];
        $telefono= $_POST['telefono'];
        $presupuesto= $_POST['presupuesto'];
        $query="select p.DNI,p.nombres,p.primero_apellido,p.segundo_apellido,p.contraseña,pce.correo_electronico,
        pt.telefono, upresupuesto
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
                echo "holaaaaa";
                $sql_update=mysqli_query($conexion,"update persona set DNI=$DNI,nombres=$nombres,primero_apellido=$primero_apellido,
                segundo_apellido=$segundo_apellido where DNI=$DNI;
                update persona_correo_electronico set DNI_persona=$DNI,correo_electronico=$correo_electronico
                where DNI_persona=$DNI;
                update persona_telefono set DNI=$DNI,telefono=$telefono where DNI_persona=$DNI;
                update usuario set DNI=$DNI,presupuesto=$presupuesto where DNI=$DNI;") or die ("error1");
            }
            else{
                $sql_update=mysqli_query($conexion,"update persona p set p.DNI=$DNI,p.contraseña=$contraseña,p.nombres=$nombres,p.primero_apellido=$primero_apellido,
                p.segundo_apellido=$segundo_apellido where p.DNI=$DNI;
                update persona_correo_electronico pce set pce.DNI_persona=$DNI,pce.correo_electronico=$correo_electronico
                where pce.DNI_persona=$DNI;
                update persona_telefono pt set pt.DNI=$DNI,pt.telefono=$telefono where pt.DNI_persona=$DNI;
                update usuario u set u.DNI=$DNI,u.presupuesto=$presupuesto where u.DNI=$DNI;") or die ("error2");
            }
            if($sql_update)
            {
                $message="datos insertados";
                $class="alert alert-success";

            }
            else{
                $message="no se pudo";  
                $class="alert alert-danger";

            }
        }

}

    ?>
    <div class="<?php echo $class;?>
<?php echo $message?>">
				 
				</div>
</body>
</html>