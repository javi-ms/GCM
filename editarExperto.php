<?php
	session_start();
	require_once 'clases/experto.php';
	require_once 'clases/categoria.php';
	include 'funciones/funciones.php';
	include 'includes/header.php';
	include 'includes/body.php';

	if(isset($_GET['indice'])){
		$_SESSION['id']=$_GET['indice'];
		$categoria = categoria::singleton();
		$arrayCategorias = $categoria->get_categorias();
		$experto = experto::singleton();
        $exp = $experto->get_experto($_GET['indice']);
		?>
    	<h1>Editar experto</h1>
    	
    	<br/>

		<form method="post" action="guardarExpertoEditado.php">
			<label>Nombre: </label><?php

			echo "<input type=\"text\" name=\"nombre\" value=\"".$exp['nombre']."\"><br/><br/>";
			echo "<label>Usuario: </label>";
			echo "<input type=\"text\" name=\"usuario\" value=\"".$exp['usuario']."\"><br/><br/>";
			echo "<label>Contraseña: </label>";
			echo "<input type=\"password\" name=\"pass\" value=\"".$exp['password']."\"><br/><br/>";
			echo "<label>Email: </label>";
			echo "<input type=\"text\" name=\"email\" value=\"".$exp['email']."\"><br/><br/>";

			echo "<h3>Categorías</h3><br/>";

			foreach ($arrayCategorias as $key => $value) {
    			echo "<input type=\"checkbox\" name=\"categorias[]\" value=\"".$value[0]."\">".$value[0];
	    		echo "<br/>";
    		}

	    	echo "<br/><br/>";


			?>
			<input type="submit" class="btn btn-primary" name="enviar" value="Editar">
			<form style="display: inline;" method="post" action="index.php">
				<input type="submit" class="btn btn-primary" name="volver" value="Volver">
			</form>
		</form>
			<?php
	}
		
	
?>