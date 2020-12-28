<?php 

$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
            $consulta=
            "SELECT pe.id_pedido,us.DNI,per.primero_apellido,per.segundo_apellido,per.nombres,pro.precio,al.cantidad_productos,pe.precio 'precio total',
            al.fecha_pedido,al.fecha_entrega,bici.foto,pro.id_producto
            from pedido pe
            inner join almacena al
            on al.id_pedido=pe.id_pedido
            inner join usuario us
            on us.DNI=pe.DNI_cliente
            inner join persona per
            on per.DNI=us.DNI
            inner join producto pro
            on pro.id_producto=al.id_producto
            inner join bicicleta bici
            on bici.id_producto=pro.id_producto;";
?>
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
    <title>Lista Pedidos</title>
</head>
<style>
    img{
        width: 150px;
        height: 150px;
    }
</style>
<body>
    <div >
        <a type="button" href="../adminindex.php" class="btn btn-success">Atras</a>
    </div>
    <div class="container">
        <div class="table-container">
            <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Listado de  <b>Pedido</b></h2></div>
                    </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>id pedido</th>
                    <th>DNI usuario</th>
                    <th>Primero Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Nombres</th>
                    <th>Precio producto</th>
                    <th>Cantidad Producto</th>
                    <th>Precio total</th>
                    <th>Fecha Pedido</th>
                    <th>Fecha entrega</th>
                    <th>Id producto</th>
                </tr>
                
                    <?php 


                    $query=mysqli_query($conexion,$consulta) or die("error");
                    while($row=mysqli_fetch_array($query))
                    {
                        
                        $id_pedido=$row['id_pedido'];
                        $id_producto=$row['id_producto'];
                        $DNI=$row['DNI'];
                        $primero_apellido=$row['primero_apellido'];
                        $segundo_apellido=$row['segundo_apellido'];
                        $nombres=$row['nombres'];
                        $precio=$row['precio'];
                        $cantidad_productos=$row['cantidad_productos'];
                        $fecha_pedido=$row['fecha_pedido'];
                        $fecha_entrega=$row['fecha_entrega'];
                        ?>
                    <tr class="table-success">
                        <td><?php echo $id_pedido;?></td>
                        <td><?php echo $DNI;?></td>
                        <td><?php echo $primero_apellido;?></td>
                        <td><?php echo $segundo_apellido;?></td>
                        <td><?php echo $nombres;?></td>
                        <td><?php echo $precio;?></td>
                        <td><?php echo $cantidad_productos;?></td>
                        <td><?php echo $precio*$cantidad_productos;?></td>
                        <td><?php echo $fecha_pedido;?></td>
                        <td><?php echo $fecha_entrega;?></td>
                        <td><?php echo $id_producto;?></td>
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