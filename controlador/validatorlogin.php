<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        session_start();
        require_once('../config.php');
        $email = $_POST['email'];
        $pass = $_POST['password'];
        echo $email;
        $consulta="
        CALL buscar_administrador(".$pass.",".$email.")";
        $r = mysqli_query($conexion,$consulta);
        /* if(!$r){
            echo "<h1>Usuario o contraseña inválido</h1>";
            echo "<meta http-equiv='refresh' content='10;url='../view/loginadmin.php'/>";
        } */
        $rt= mysqli_fetch_row($r);
        echo $rt[1];
    }
?>
</body>
</html>