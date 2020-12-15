<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <title>Eliminar</title>
</head>
<body>
    
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" id="editar"href="crud/bicicleta_montañera/eliminar.php">eliminar bicicleta Montañera</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="eliminar" href="crud/bicicleta_infantil/eliminar.php">eliminar bicicleta infantil </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"id="mostrar" href="crud/bicicleta_urbana/eliminar.php">eliminar bicicleta urbana</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="insertar" href="crud/bicicleta_urbana/eliminar.php">eliminar bicicleta freestyle</a>
    </li>
</ul>
</nav>
<div id="page"></div>
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