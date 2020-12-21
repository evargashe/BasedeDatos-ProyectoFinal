<?php 
    if (isset($_GET['id_producto'])){
        $conexion = mysqli_connect(
            'localhost:8080',
            'root',
            'andre123') or die ("problemas en la conexion");
        mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");

        $id=intval($_GET['id_producto']);
        
        $consulta="delete from bici_infantil where id_producto=$id";
        $consulta1="delete from bicicleta where id_producto=$id";
        $consulta2="delete from producto where id_producto=$id";
        $res=mysqli_query($conexion,$consulta);
        $res1=mysqli_query($conexion,$consulta1);
        $res2=mysqli_query($conexion,$consulta2);
        if($res && $res1 && $res2){
            header('location: mostrar.php');
        }else{
            echo "Error al eliminar el registro";
        }
        /* echo "<br>";
        $con="select color, material from bicicleta where id_producto=$id";
        $r=mysqli_query($conexion,$con);
        while($row=mysqli_fetch_array($r))
        {
            echo $row['color']; echo "<br>";
            echo $row['material'];
                    
        } */
    }
?>