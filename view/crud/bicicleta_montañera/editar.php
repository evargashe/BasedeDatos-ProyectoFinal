
<?php
	if (isset($_GET['id_producto'])){
		$id_producto=$_GET['id_producto'];
	} else {
		header("location:mostrar.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD con PHP usando Programación Orientada a Objetos</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Bicicleta Montañera</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
				
				$conexion = mysqli_connect(
                    'localhost:8080',
                    'root',
                    'andre123') or die ("problemas en la conexion");
                mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
                
				
				if(isset($_POST) && !empty($_POST)){
					$id_producto =$_POST['id_producto'];
					$precio = $_POST['precio'];
					$color = $_POST['color'];
					$material = $_POST['material'];
					$objeto_extra = $_POST['objeto_extra'];
                    $res = "call actualizar_bici_montañera('".$id_producto."', '".$precio."','".$color."',
                    '".$material."', '".$objeto_extra."')";
                    $consulta=mysqli_query($conexion,$res);
					if($res){
						$message= "Datos actualizados con éxito";
						$class="alert alert-success";
						
					}else{
						$message="No se pudieron actualizar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
                    <?php
                }
                $ro="call actualizar_bici_montañera_id($id_producto)";
				$row2=mysqli_query($conexion,$ro);
				while($row=mysqli_fetch_array($row2))
                {
					$id_producto=$row['id_producto'];
					$precio=$row['precio'];
					$color=$row['color'];
					$material=$row['material'];
					$extra=$row['objeto_extra'];
						
				
                ?>
			<div class="row">
				<form method="post">
				<div class="col-md-6">
					<label>ID PRODUCTO</label>
					<input type="text" name="id_producto" id="id_producto" class='form-control' maxlength="100" required  value="<?php echo $row['id_producto'];?>">
				</div>
				<div class="col-md-6">
					<label>PRECIO</label>
					<input type="text" name="precio" id="precio" class='form-control' maxlength="100" required value="<?php echo $row['precio'];?>">
				</div>
				<div class="col-md-12">
					<label>COLOR:</label>
					<textarea  name="color" id="color" class='form-control' maxlength="255" required><?php echo $row['color'];?></textarea>
				</div>
				<div class="col-md-6">
					<label>MATERIAL</label>
					<input type="text" name="material" id="material" class='form-control' maxlength="15" required value="<?php echo $row['material'];?>">
				</div>
				<div class="col-md-6">
					<label>OBJETO EXTRA:</label>
					<input type="text" name="objeto_extra" id="objeto_extra" class='form-control' maxlength="64" required value="<?php echo $row['objeto_extra'];?>">
				
				</div>
				
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
				<?php } ?>
				</form>
			</div>
        </div>
    </div>     
</body>
</html>