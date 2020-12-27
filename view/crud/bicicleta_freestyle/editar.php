
<?php
	session_start();
	$conexion = mysqli_connect(
		'localhost:8080',
		'root',
		'andre123') or die ("problemas en la conexion");
	mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
	$message="";
	$class="";
	if (isset($_GET['id_producto'])){
		$id_producto=$_GET['id_producto'];
	} else {
		header("location:mostrar.php");
	}

	if(!empty($_POST))
	{
			$id_producto =$_POST['id_producto'];
			$precio = $_POST['precio'];
			$color = $_POST['color'];
			$material = $_POST['material'];
			$fotoActual= $_POST['foto_actual'];
			$fotoRemove= $_POST['foto_remove'];

			$foto= $_FILES['foto'];
			$nombre_foto= $foto['name'];
			$type= $foto['type'];
			$url_temp= $foto['tmp_name'];

			$upd= '';
			if($nombre_foto != '')
			{
				$destino= 'img/uploader/';
				$img_nombre= 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto= $img_nombre.'.jpg';
				$src= $destino.$imgProducto;
			}else{
				if($_POST['foto_actual'] != $_POST['foto_remove'])
				{
					$imgProducto= 'images.jpg';
				}
			}

			$query="call actualizar_bici_freestyle('".$id_producto."','".$precio."','".$color."',
			'".$material."','".$imgProducto."')";
			$query_update= mysqli_query($conexion,$query) or die ("error");
			if($query_update){

				if($nombre_foto != '' && ($_POST['foto_actual']!='images.jpg') || ($_POST['foto_actual'] != $_POST['foto_remove']))
				{
					unlink("./img/uploader/".$_POST['foto_actual']);
				}
				if($nombre_foto != '')
				{
					move_uploaded_file($url_temp,$src);
				}
				$message="Producto actualizado";
				$class="alert alert-success";
				echo "<meta http-equiv='refresh' content='2;url=./mostrar.php'/>";
			
			}
			else{
				$message="Error al actualizar producto";
				$class="alert alert-danger";
				echo "<meta http-equiv='refresh' content='2;url=./editar.php'/>";

			}
		
	}


	//
	if(empty($_REQUEST['id_producto']))
	{
		header("location:mostrar.php");
	}
	else{
		$id_producto=  $_REQUEST['id_producto'];
		if(!is_numeric($id_producto))
		{
			header("location:mostrar.php");
		}
		$query=mysqli_query($conexion,"call actualizar_bici_freestyle_id('".$id_producto."')") or die("");
		$result_producto=mysqli_num_rows($query);

		$foto='';
		$classRemove='notBlock';
		if($result_producto>0)
		{
			$data_producto=mysqli_fetch_assoc($query);
			print_r($data_producto);
			if($data_producto['foto']!='images.jpg')
			{
				$classRemove='';
				$foto= '<img id="img" src="./img/uploader/'.$data_producto['foto'].'" alt="Producto">';
			}
		}
		else{
			header("location: mostrar.php");
		}
		
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Editar</title>
</head>
<style>
	.prevPhoto {
    display: flex;
    justify-content: space-between;
    width: 160px;
    height: 150px;
    border: 1px solid #CCC;
    position: relative;
    cursor: pointer;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    margin: auto;
}
.prevPhoto label{
	cursor: pointer;
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2;
}
.prevPhoto img{
	width: 100%;
	height: 100%;
}
.upimg, .notBlock{
	display: none !important;
}
.errorArchivo{
	font-size: 16px;
	font-family: arial;
	color: #cc0000;
	text-align: center;
	font-weight: bold; 
	margin-top: 10px;
}
.delPhoto{
	color: #FFF;
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
	justify-content: center;
	align-items: center;
	border-radius: 50%;
	width: 25px;
	height: 25px;
	background: red;
	position: absolute;
	right: -10px;
	top: -10px;
	z-index: 10;
}
#tbl_list_productos img{
	width: 50px;
}
.imgProductoDelete{
	width: 175px;
}
</style>
</style>
<body>
	<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Bicicleta freestyle</b></h2></div>
                    <!-- <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div> -->
                </div>
            </div>
        
			<div class="row">
				<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="foto_actual" id="foto_actual" value="<?php echo $data_producto['foto'];?>">
				<input type="hidden" name="foto_remove" id="foto_remove" value="<?php echo $data_producto['foto'];?>">

				<div class="col-md-6">
					<label>ID PRODUCTO</label>
					<input type="text" name="id_producto" id="id_producto" class='form-control' maxlength="100" required value="<?php echo $data_producto['id_producto'];?>">
				</div>
				<div class="col-md-6">
					<label>PRECIO</label>
					<input type="text" name="precio" id="precio" class='form-control' maxlength="100" required value="<?php echo $data_producto['precio'];?>">
				</div>
				<div class="col-md-12">
					<label>COLOR:</label>
					<textarea  name="color" id="color" class='form-control' maxlength="255" required><?php echo $data_producto['color'];?></textarea>
				</div>
				<div class="col-md-6">
					<label>MATERIAL</label>
					<input type="text" name="material" id="material" class='form-control' maxlength="15" required value="<?php echo $data_producto['material'];?>">
				</div>
				<label for="foto">Foto</label>
					<div class="prevPhoto">
					<span class="delPhoto <?php echo $classRemove;?>">X</span>
					<label for="foto"></label>
					<?php echo $foto?>
					</div>
					<div class="upimg">
					<input type="file" name="foto" id="foto">
					</div>
					<div id="form_alert"></div>
					</div>
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
				</form>
			</div>
        </div>
    </div>     
</body>
<script>
	$(document).ready(function(){

//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
$("#foto").on("change",function(){
	var uploadFoto = document.getElementById("foto").value;
	var foto       = document.getElementById("foto").files;
	var nav = window.URL || window.webkitURL;
	var contactAlert = document.getElementById('form_alert');
	
		if(uploadFoto !='')
		{
			var type = foto[0].type;
			var name = foto[0].name;
			if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
			{
				contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
				$("#img").remove();
				$(".delPhoto").addClass('notBlock');
				$('#foto').val('');
				return false;
			}else{  
					contactAlert.innerHTML='';
					$("#img").remove();
					$(".delPhoto").removeClass('notBlock');
					var objeto_url = nav.createObjectURL(this.files[0]);
					$(".prevPhoto").append("<img id='img' src="+objeto_url+">");
					$(".upimg label").remove();
					
				}
		  }else{
			  alert("No selecciono foto");
			$("#img").remove();
		  }              
});

$('.delPhoto').click(function(){
	$('#foto').val('');
	$(".delPhoto").addClass('notBlock');
	$("#img").remove();

});

});
</script>
</html>¿