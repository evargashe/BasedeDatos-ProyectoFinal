<?php require "layout/header.php" ?>
<a href="index.php?m=nuevo">NUEVO</a>
<table border="1">
	<tr>
		<td>Id</td>
		<td>Nombre</td>
		<td>Precio</td>
		<td>Acción</td>
	</tr>
	    <?php
	    foreach ($dato as $key => $value)
	        foreach ($value as $va ):
	            echo "<tr><td>".$va['id']."</td><td>".$va['nombre']."</td><td>S./".$va['precio']."</td>";
	        	echo "<td><a href='index.php?m=editar&id=".$va['id']."'>ACTUALIZAR</a> <a href='index.php?m=eliminar&id=".$va['id']."'>ELIMINAR</a></td>";
	        	echo "</tr>";
	        endforeach;
	    ?>
</table>
<?php require "layout/footer.php" ?>
