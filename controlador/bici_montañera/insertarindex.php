<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(($_SERVER['REQUEST_METHOD']=='POST')){
        $conexion = mysqli_connect(
            'localhost:8080',
            'root',
            'andre123') or die ("problemas en la conexion");
        mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

        
        $id_producto= $_POST['id_producto'];
        $precio= $_POST['precio'];
        $color= $_POST['color'];
        $material= $_POST['material'];
        $objeto_extra= $_POST['objeto_extra'];

        $cons = "CALL insertar_bicicleta_montañera('".$id_producto."','".$precio."',
        '".$color."','".$material."','".$objeto_extra."')";
        $r=mysqli_query($conexion,$cons);
        if($r){
            $message= "Datos insertados con éxito";
            $class="alert alert-success";
        }else{
            $message="No se pudieron insertar los datos";
            $class="alert alert-danger";
        }
        ?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
    }
    ?>
</body>
</html>