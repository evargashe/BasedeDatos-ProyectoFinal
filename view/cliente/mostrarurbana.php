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
    
    <title>Mostrar bicicleta urbana</title>
</head>
<style>
    img{
        width: 150px;
        height: 150px;
    }
</style>
<body>

    <?php
        $conexion = mysqli_connect(
            'localhost:8080',
            'root',
            'andre123') or die ("problemas en la conexion");
        mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
        
    ?>
    <div class="col-sm-4">
                        <a href="./mostrar.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
    </div>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Listado de  <b>Bicicleta Urbana</b></h2></div>
                </div>
            </div>
            <form action="./buscar_usuario_urbana.php" method="get">
                <input type="text" name="busqueda" id="busqueda" placeholder="busque su producto por id">
                <input type="submit" value="Buscar" class="btn btn-search">
            </form>

            <?php
            
            $consulta="call mostrar_bici_urbana()";
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
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>                        
                    <?php
                        while($row=mysqli_fetch_array($r))
                        {
                            $id_producto=$row['id_producto'];
                            if($row['foto']!='images.jpg'){
                                $foto='../crud/bicicleta_urbana/img/uploader/'.$row['foto'];
                            }
                            else{
                                $foto='../crud/bicicleta_urbana/img/images.jpg';
                            }
                        ?>
                    <tr>
                        <td> <?php echo $row['id_producto']; ?></td>
                        <td> <?php echo $row['precio']; ?></td>
                        <td> <?php echo $row['color']; ?></td>
                        <td> <?php echo $row['material']; ?></td>
                        <td> <?php echo $row['objeto_extra']; ?></td>
                        <td><img src="<?php echo $foto;?>" alt="<?php echo $row['foto'];?>"></td>
                        <td>
                        <a href="comprar/urbana.php?id_producto=<?php echo $id_producto;?>" class="comprar" title="comprar" data-toggle="tooltip">Comprar</a>
                        </td>
                        <?php } ?>
                    </tr>
                    
                        
                </thead>
                    
                <tbody>    
                            
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html>