<?php 

session_start();
if(empty($_SESSION['active']))
{
    header('location: ../cliente.php');
}
$conexion = mysqli_connect(
    'localhost:8080',
    'root',
    'andre123') or die ("problemas en la conexion");
mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
$DNI= $_SESSION['DNI'];
$message="";
$class="";
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
    
    <title>Comprar</title>
</head>
<body>
<?php 
    if (isset($_GET['id_producto'])){
        

        $id_producto=intval($_GET['id_producto']);
        
        $cons="select p.id_producto,p.precio
        from producto p
        where p.id_producto=$id_producto;";
        $query1=mysqli_query($conexion,$cons) or die("error1");
        $row=mysqli_fetch_array($query1) ;
        $precio=$row['precio'];
        
        /* $consultainser="INSERT into pedido values('".$id_producto."','".$precio."','".$DNI."');";
        $consultaupt="update usuario u set u.presupuesto=u.presupuesto-$precio where u.DNI=$id_producto;";
        $query_insert=mysqli_query($conexion,$consultainser);
        $query_update=mysqli_query($conexion,$consultaupt);

         if($query_update && $query_insert)
         {
             echo "compra satisfecha";
         }
         else{
             echo "no se realizo la compra";
         } */
        
       
    }
    if(!empty($_POST))
    {

        $id_pedido= $_POST['id_pedido'];
        $id_producto= $_POST['id_producto'];
        $cantidad_productos= $_POST['cantidad_productos'];
        $fecha_pedido= $_POST['fecha_pedido'];
        $fecha_entrega= $_POST['fecha_entrega'];
        $precio= $_POST['precio'];
        $consulta_pedido="insert into pedido values($id_pedido,$precio*$cantidad_productos,$DNI)";
        $consulta_almacena="insert into almacena values('".$id_pedido."','".$id_producto."','".$cantidad_productos."',
        '".$fecha_pedido."','".$fecha_entrega."')";

        $query_pedido=mysqli_query($conexion,$consulta_pedido) or die("error pedido");
        $query_almacena=mysqli_query($conexion,$consulta_almacena) or die("error almacena");
        if($query_pedido && $query_almacena)
        {
            $message="Comprar Satisfecha";
                $class="alert alert-success";				
            echo "<meta http-equiv='refresh' content='2;url=../mostrarmontañera.php'/>";

        }
        else{
            $message="Error al comprar o el producto ya fue comprado producto";
                $class="alert alert-danger";
                echo "<meta http-equiv='refresh' content='2;url=./montañera.php'/>";

        }

    }
?>
<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>
<form method="post">
				<div class="col-md-6">
					<label>Id producto</label>
                    <input type="text" name="id_producto" id="id_producto" class='form-control' maxlength="100" 
                    value="<?php echo $id_producto;?>">
                </div>
                <div class="col-md-6">
					<label>Id pedido</label>
					<input type="text" name="id_pedido" id="id_pedido" class='form-control' maxlength="100" required >
				</div>
				<div class="col-md-6">
					<label>Precio</label>
                    <input type="number" name="precio" id="precio" class='form-control' maxlength="100"
                    value="<?php echo $precio;?>">
				</div>
				<div class="col-md-12">
					<label>DNI</label>
                    <input type="number" name="DNI" id="DNI" class='form-control' maxlength="15" 
                    value="<?php echo $DNI;?>">
				</div>
				<div class="col-md-6">
                    <?php $fcha = date("Y-m-d");?>

					<label>Fecha pedido:</label>
                    <input  name="fecha_pedido" id="fecha_pedido" class='form-control' maxlength="15" 
                    value="<?php echo $fcha;?>">
                </div>
                <div class="col-md-6">
                <?php $fcha = date("Y-m-d");?>

					<label>Fecha entrega:</label>
                    <input name="fecha_entrega" id="fecha_entrega" class='form-control' maxlength="15" required 
                    value="<?php echo $fcha;?>">
                </div>
                <div class="col-md-6">
					<label>Cantidad productos</label>
					<input type="number" name="cantidad_productos" id="cantidad_productos" class='form-control' maxlength="15" required >
				</div>
				<div class="col-md-12 pull-right">
					<button type="submit" class="btn btn-success">Comprar Producto</button>
				</div>
				</form>
</body>
</html>