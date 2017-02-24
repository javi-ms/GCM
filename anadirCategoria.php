<?php
	session_start();
	require_once 'clases/categoria.php';
	include 'includes/header.php';
	include 'includes/body.php';
    include 'funciones/funciones.php';

    if(!isset($_POST['anadirCategoria']))
		header("Location: index.php");
	else{?>
		<h1>Nueva categoría</h1>
    	
    	<br/>

		<form method="post" action="nuevaCategoria.php">
			<label>Categoría: </label>
			<input type="text" name="categoria"><br/><br/>
			<input type="submit" class="btn btn-primary" name="enviar" value="Añadir">
		</form>
		<form style="display: inline;" method="post" action="index.php">
			<input type="submit" class="btn btn-primary" name="volver" value="Volver">
		</form>
		
	<?php
	}

	include 'includes/footer.php';
?>