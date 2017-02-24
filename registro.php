<?php
	session_start();
	require_once 'clases/categoria.php';
	include 'includes/header.php';
	include 'includes/body.php';
    include 'funciones/funciones.php';

    if(!isset($_POST['registro']))
		header("Location: index.php");
	else{
		$categoria = categoria::singleton();
		$arrayCategorias = $categoria->get_categorias();
		?>
    	<h1>Registro</h1>
    	
    	<br/>

		<form method="post" action="nuevoExperto.php">
			<label>Nombre: </label>
			<input type="text" name="nombre"><br/><br/>
			<label>Usuario: </label>
			<input type="text" name="usuario"><br/><br/>
			<label>Contraseña: </label>
			<input type="password" name="pass"><br/><br/>
			<label>Email: </label>
			<input type="text" name="email"><br/><br/><?php

			echo "<h3>Categorías</h3><br/>";

			foreach ($arrayCategorias as $key => $value) {
    			echo "<input type=\"checkbox\" name=\"categorias[]\" value=\"".$value[0]."\">".$value[0];
	    		echo "<br/>";
    		}

	    	echo "<br/><br/>";


			?>
			<input type="submit" class="btn btn-primary" name="enviar" value="Registrar">

		<form style="display: inline;" method="post" action="index.php">
			<input type="submit" class="btn btn-primary" name="volver" value="Volver">
		</form>
		
	<?php
	}

	include 'includes/footer.php';
?>