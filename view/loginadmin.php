<?php

    $message="";
    $class="";
    session_start();

    if(!empty($_SESSION['active']))
    {
        header('location: ./loginadmin.php');
    }else{
        if(!empty($_POST)){
            if(empty($_POST['correo_electronico']) || empty($_POST['contraseña']))
            {
                $message='ingrese su usuario y su clave';
                $class="alert alert-danger";
                echo "<meta http-equiv='refresh' content='2;url=./loginadmin.php'/>";

            }
            else{
                $conexion = mysqli_connect(
                    'localhost:8080',
                    'root',
                    'andre123') or die ("problemas en la conexion");
                mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
                $correo_electronico="";
                $cons="";
                
                    
                    $contraseña= $_POST['contraseña'];
                    $correo_electronico= $_POST['correo_electronico'];
                    $consulta= "select p.DNI,pce.correo_electronico,p.contraseña  
                    from persona p
                    inner join persona_correo_electronico pce
                    on p.DNI=pce.DNI_persona
                    inner join administrador a
                    on p.DNI=a.DNI and pce.DNI_persona=a.DNI
                    where pce.correo_electronico='$correo_electronico' and p.contraseña='$contraseña';";
                    $resultado = mysqli_query($conexion,$consulta) or die("no se pudo hacer la consulta");
                    $result= mysqli_num_rows($resultado);
                    if($result>0)
                    {
                        $row = mysqli_fetch_array($resultado);
                        print_r($row);
                        $_SESSION['active']=True;
                        $_SESSION['DNI']=$row['DNI'];
                        $_SESSION['correo_electronico']=$row['correo_electronico'];
                        $_SESSION['contraseña']=$row['contraseña'];
                        header('location: adminindex.php');

                    }
                    else{
                        $message='Usuario y clase incorrectos';
                        $class="alert alert-danger";
                        echo "<meta http-equiv='refresh' content='2;url=./loginadmin.php'/>";
                        session_destroy();
                        
                    }
                    
                    /* if($row['correo_electronico']==$correo_electronico && $row['contraseña']==$contraseña)
                    { 
                        $dni=$row['DNI'];
                        $resultado=True;
                    }
                    if($resultado)
                    {
                        $message= "Datos correctos";
                            $class="alert alert-success";
                            echo "<meta http-equiv='refresh' content='2;url=./cliente/indexcliente.php'/>";
            
                    }
                    else{
                        $message="Usuario y contraseña incorrectos";
                            $class="alert alert-danger";
                            echo "<meta http-equiv='refresh' content='2;url=./cliente.php'/>";
                    } */
            
                
            }
        }
    }
    
?>

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
    <title>Login Admin</title>
</head>
<style>
form{
margin-left: 500px;
margin-top: 50px;
border: 3px solid #f1f1f1;
background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
color: black;
}
p{
font-size: 30px;
text-align: center;
}
#btnentrar{
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
width: 100%;
}
#btnentrar:hover {
opacity: 0.8;
}
#logo{
    height: 150px;
    width: 150px;
    margin-left: 500px;
    border: 3px solid black;
    border-radius: 50%;
    border-top-left-radius: 50% 50%;
    border-top-right-radius: 50% 50%;
    border-bottom-right-radius: 50% 50%;
    border-bottom-left-radius: 50% 50%;
}

</style>
<body>


<div class="<?php echo $class?>">
              <?php echo $message;?>
            </div>

    
    <form  method="post" class="container">
        <img id="logo" src="./img/administrador.jpg" alt="logo">
    <p>Login Administrador</p>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="correo_electronico"class="form-control" id="email" placeholder="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="contraseña"class="form-control" id="password" placeholder="password">
            </div>
        </div>
        <button type="submit" id="btnentrar" onclick="location.href='adminindex.php'"class="btn btn-primary">Sign in</button>
    </form>
    <a class="btn btn-primary" href="./index.php" role="button">Volver</a>
</body>
</html>