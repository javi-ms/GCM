<?php
	session_start();
	require_once 'clases/categoria.php';
	include 'includes/header.php';
	include 'includes/body.php';

	if(!isset($_POST['enviar'])){
		header("Location: index.php");
	}

	else{
		if(empty($_POST['categoria'])){
			echo "<h2>No se ha podido añadir</h2><br/>";
			echo "<h5>El campo está vacío</h5><br/>";?>
			<form style="display: inline;" method="post" action="index.php">
				<input type="submit" class="btn btn-primary" name="volver" value="Volver">
			</form><?php
		}

		else{
			$categoria = categoria::singleton();
			$categoria->anadir_categoria($_POST['categoria']);

			echo "<h2>Categoría añadida</h2><br/>";
			echo "<h5>".$_POST['categoria']."</h5><br/>";

			echo "<br/><br/>";

			?>

			<form style="display: inline;" method="post" action="index.php">
				<input type="submit" class="btn btn-primary" name="volver" value="Volver">
			</form>
			<?php
		}
	}

		

	include 'includes/footer.php';
?>