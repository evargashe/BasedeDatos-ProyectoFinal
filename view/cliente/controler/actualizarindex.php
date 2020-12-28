
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


}

    ?>
    <div class="<?php echo $class;?>
<?php echo $message?>">
				 
				</div>
</body>
</html>