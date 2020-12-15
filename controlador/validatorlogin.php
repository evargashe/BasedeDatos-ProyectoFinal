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
        $cons="select pce.correo_electronico,p.contraseña  
        from persona p
        inner join persona_correo_electronico pce
        on p.DNI=pce.DNI_persona
        inner join administrador a
        on p.DNI=a.DNI and pce.DNI_persona=a.DNI
        group by p.DNI;";
        $r2=mysqli_query($conexion,$cons);
        $row=mysqli_fetch_array($r2);
        $foo=False;
        while($row)
        {
            if($row['correo_electronico']==$email && $row['contraseña']==$pass)
            {

                $foo=True;
                break;
            }
            else{
                echo "<h1>Usuario o contraseña inválido</h1>";
                break;
            }
        }
        /* if(!$r2){
            echo "<h1>Usuario o contraseña inválido</h1>";
            echo "<meta http-equiv='refresh' content='10;url='../view/loginadmin.php'/>";
        } */
        if($foo)
        {
            echo "<a href='../view/adminindex.php'>ir a la venta principal</a>";
        }
    }
?>
</body>
</html>