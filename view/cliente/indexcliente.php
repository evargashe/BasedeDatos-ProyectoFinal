<?php 

session_start();
if(empty($_SESSION['active']))
{
    header('location: ../cliente.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Cliente</title>
</head>
<style>
    img{
        height: 30px;
        width: 30px;
        margin-left: 25px;
        margin-bottom: 10px;
    }
    span{
        color:aliceblue;
        margin-right: 25px;
    }
</style>
<body>
    <header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">          
         <img alt="Brand" id="logo"src="./img/icono-del-vector-de-la-persona-en-nuevo-estilo-plano-usuario-símbolo-humano-con-sombra-larga-ejemplo-internet-horas-servicio-141808591.jpg">
    </a>
    <span class="user mb-2"><?php echo $_SESSION['nombres'];?></span>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link"id="mostrar" href="./mostrar.php">Mostrar Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="datos" href="./datoscliente.php">Datos usuario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="listado" href="./listapedidos.php">Listado de pedidos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="salir" href="./salirindexcliente.php">Salir</a>
        </li>
        
    </ul>
    </nav>
    <div id="page"></div>
    </header>

</body>
<script>
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
</script>
</html>