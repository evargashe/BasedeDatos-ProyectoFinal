<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Registrar Cliente</title>
</head>
<style>
    body{
        background: gray;
    }
form{
    color: black;   

    margin-left: 480px;
    margin-top: 50px;
    border: 3px solid #f1f1f1;
    background-image: linear-gradient(to right bottom, #356dbb, #3666a9, #385f96, #395885, #3a5173);
    border-radius: 10px;

}
p{
    font-size: 25px;
    text-align: center;
}
#btnregistrar{
    background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
#btnregistrar:hover {
  opacity: 0.8;
}



</style>
<body>
    <?php $message=""; $class=""; ?>
    <?php
        require_once('../config.php');

        if(($_SERVER['REQUEST_METHOD']=='POST')){

            $dni= $_POST['DNI'];
            $nombres= $_POST['nombres'];
            $primero_apellido= $_POST['primero_apellido'];
            $segundo_apellido= $_POST['segundo_apellido'];
            $contraseña= $_POST['contraseña'];
            $correo_electronico= $_POST['correo_electronico'];
            $telefono= $_POST['telefono'];
            $presupuesto=$_POST['presupuesto'];
            $consulta= "call registrar_cliente('".$dni."','".$nombres."','".$primero_apellido."',
            '".$segundo_apellido."','".$contraseña."',
            '".$correo_electronico."','".$telefono."','".$presupuesto."');";
            $resultado = mysqli_query($conexion,$consulta);
            if($resultado)
            {
                $message= "Datos insertados con éxito";
                $class="alert alert-success";
                echo "<meta http-equiv='refresh' content='5;url=./cliente.php'/>";
            }else{
                $message="No se pudieron insertar los datos";
                $class="alert alert-danger";
                echo "<meta http-equiv='refresh' content='5;url=./registrarcliente.php'/>";
            }
            	
        }
    
    ?>
    <div class="<?php echo $class?>">
				  <?php echo $message;?>
                </div>	
                
        <div class="form-group">
            <a href="./cliente.php"><button type="button"class="btn btn-outline-succes">Regresar</button></a>
        </div>
    <form method="POST" class="container">
        
        <p>Registrar</p>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4" >DNI</label>
                <input type="number" class="form-control m-3" id="DNI" name="DNI">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nombres</label>
                <input type="text" class="form-control m-3" name="nombres" id="nombres" >
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Apellido Paterno</label>
                <input type="text" class="form-control m-3" id="primero_apellido" name="primero_apellido">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Apellido Materno</label>
                <input type="test" class="form-control m-3" id="segundo_apellido" name="segundo_apellido">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Telefono</label>
                <input type="number" class="form-control m-3" id="telefono" name="telefono">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Email</label>
                <input type="email" class="form-control m-3" id="correo_electronico" name="correo_electronico">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control m-3" id="contraseña" name="contraseña">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Presupuesto</label>
                <input type="number" class="form-control m-3" id="presupuesto" name="presupuesto">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" id="btnregistrar"class="btn btn-primary">Registrarse</button>
        </div>
    </form>
</body>
</html>