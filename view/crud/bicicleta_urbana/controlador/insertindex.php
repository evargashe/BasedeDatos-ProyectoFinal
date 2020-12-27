<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
<?php
    $message="";
    $class="";
        $conexion = mysqli_connect(
            'localhost:8080',
            'root',
            'andre123') or die ("problemas en la conexion");
        mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

        if(!empty($_POST)){

            if(empty($_POST['id_producto']) || empty($_POST['precio']) || empty($_POST['color']) || empty($_POST['material']) || empty($_POST['objeto_extra']))
            {
                $message="todos los campos son obligatorios";
                $class="alert alert-danger";
                echo "<meta http-equiv='refresh' content='2;url=./insertar.php'/>";
            }
            else{
                $id_producto= $_POST['id_producto'];
                $precio= $_POST['precio'];
                $color= $_POST['color'];
                $material= $_POST['material'];
                $objeto_extra= $_POST['objeto_extra'];

                $foto= $_FILES['foto'];
                $nombre_foto=$foto['name'];
                $type=$foto['type'];
                $url_temp=$foto['tmp_name'];

                $imgProducto='images.jpg';
                if($nombre_foto != '')
                {
                    $destino='../img/uploader/';
                    $img_nombre='img_'.md5(date('d-m-Y H:m:s'));
                    $imgProducto=$img_nombre.'.jpg';
                    $src=$destino.$imgProducto;
                }
                $cons = "CALL insertar_bicicleta_urbana('".$id_producto."','".$precio."',
				'".$color."','".$material."','".$objeto_extra."','".$imgProducto."')";
				
                $r=mysqli_query($conexion,$cons);
                if($r){
                    if($nombre_foto != '')
                    {
                        move_uploaded_file($url_temp,$src);
                    }
                    $message= "Datos insertados con éxito";
                    $class="alert alert-success";
                    echo "<meta http-equiv='refresh' content='2;url= ../insertar.php'/>";

                }else{
                    $message="No se pudieron insertar los datos";
                    $class="alert alert-danger";
                    echo "<meta http-equiv='refresh' content='2;url=../insertar.php'/>";

                } 
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