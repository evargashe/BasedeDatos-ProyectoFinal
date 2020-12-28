<?php 
session_start();
if(empty($_SESSION['active']))
{
    header('location: ./loginadmin.php');
}
?>
<?php
     $conexion = mysqli_connect(
        'localhost:8080',
        'root',
        'andre123') or die ("problemas en la conexion");
    mysqli_select_db($conexion,'bicicleta') or die ("no se pudo conectar a la base de datos o no existe");
    
        $cons="select count(id_producto)
        from producto";
        $query=mysqli_query($conexion,$cons) or die("error");
        $query=mysqli_fetch_array($query);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <title>Administrador</title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link"id="mostrar" href="crud/mostrar.php">Mostrar</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" id="insertar" href="crud/insertar.php">Insertar</a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" id="lista" href="crud/listadoclientes.php">Ver pedido de cliente</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="saliradmin.php">Salir</a>
    </li>
</ul>
</nav>
<div>
    <h1>Usted tiene </h1>
    <h1>
        <?php  echo $query['count(id_producto)'] ?>

    </h1>
    <h1>Productos en total</h1>
</div>
</body>
<!-- <script>
    jQuery(document).ready(function($){
      $("a").click(function(event){
         link=$(this).attr("href");
         $.ajax({
            url: link,
         })
         .done(function(html){
            $("#page").empty().append(html);
         })
         .fail(function(){
            console.log("error");
         })
         .always(function(){
            console.log("complete");
         });
         return false;
      })

   })
</script> -->
</html>