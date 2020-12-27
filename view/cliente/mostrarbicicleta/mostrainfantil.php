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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <title>Mostrar bicicleta infantil</title>
</head>
<body>

    <?php
        $conexion = mysqli_connect(
            'localhost:8080',
            'root',
            'andre123') or die ("problemas en la conexion");
        mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
        
    ?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Listado de  <b>Bicicleta Infantil</b></h2></div>
                </div>
            </div>

            <?php
            
            $consulta="call mostrar_bici_infantil()";
            $r= mysqli_query($conexion,$consulta);

            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>COLOR</th>
                        <th>T. MATERIAL</th>
                        <th>OBJETO EXTRA</th>
                        <th>Action</th>
                    </tr>                        
                    <?php
                        while($row=mysqli_fetch_array($r))
                        {
                            $id_producto=$row['id_producto'];
                            $precio=$row['precio'];
                            $color=$row['color'];
                            $material=$row['material'];
                            $extra=$row['objeto_extra'];
                        
                        ?>
                    <tr>
                        <td> <?php echo $id_producto; ?></td>
                        <td> <?php echo $precio; ?></td>
                        <td> <?php echo $color; ?></td>
                        <td> <?php echo $material; ?></td>
                        <td> <?php echo $extra; ?></td>
                        <td>
                            <form action="" method="post">
                                <a href="">Comprar</a>
                            </form>
                        </td>

                    </tr>
                    <?php } ?>
                        
                </thead>
                    
                <tbody>    
                            
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html>