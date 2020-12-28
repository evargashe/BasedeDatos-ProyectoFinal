

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
.container{
	border: 3px solid black;
	border-radius: 10px;
}
</style>
<body>



    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Agregar <b>Producto(Bicleta Urbana)</b></h2></div>

                </div>
            </div>

			<div class="row">
				<form method="post" action="controlador/insertindex.php" enctype="multipart/form-data" >
					<div class="col-md-6">
						<label>Codigo</label>
						<input type="text" name="id_producto" id="id_producto" class='form-control' maxlength="100" required >
					</div>
					<div class="col-md-6">
						<label>Precio</label>
						<input type="text" name="precio" id="precio" class='form-control' maxlength="100" required>
					</div>
					<div class="col-md-12">
						<label>Color</label>
						<textarea  name="color" id="color" class='form-control' maxlength="255" required></textarea>
					</div>
					<div class="col-md-6">
						<label>Material:</label>
						<input type="text" name="material" id="material" class='form-control' maxlength="15" required >
					</div>
					<div class="col-md-6">
						<label>Objeto Extra:</label>
						<input type="text" name="objeto_extra" id="objeto_extra" class='form-control' maxlength="64" required>
					</div>
					<div class="photo">
					<label for="foto">Foto</label>
						<div class="prevPhoto">
						<span class="delPhoto notBlock">X</span>
						<label for="foto"></label>
						</div>
						<div class="upimg">
						<input type="file" name="foto" id="foto">
						</div>
						<div id="form_alert"></div>
					</div>
					<div class="col-md-12 pull-right">
					<hr>
						<button type="submit" class="btn btn-success">Guardar datos</button>
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
</html>