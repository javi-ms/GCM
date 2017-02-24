<?php
	session_start();
	require_once 'clases/experto.php';
	require_once 'clases/expcategorias.php';
	include 'includes/header.php';
	include 'includes/body.php';

	if(!isset($_POST['enviar'])){
		header("Location: index.php");
	}

	else{
		if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['pass']) || empty($_POST['email'])){
			echo "<h2>No se ha podido añadir</h2><br/>";
			echo "<h5>Uno de los campos está vacío</h5><br/>";?>
			<form style="display: inline;" method="post" action="index.php">
				<input type="submit" class="btn btn-primary" name="volver" value="Volver">
			</form><?php
		}

		else{
			$experto = experto::singleton();
			$experto->editar_experto($_POST['nombre'],$_POST['usuario'],$_POST['pass'],$_POST['email'],$_SESSION['id']);

			$expcat = expcategorias::singleton();
			$expcat->borrar_experto_categoria($_SESSION['id']);

			foreach ($_POST['categorias'] as $value) {
				$expcat->anadir_experto_categoria($_SESSION['id'],$value);	
			}

			echo "<h2>Experto editado</h2><br/>";
			echo "<br/><br/>";?>

			<form style="display: inline;" method="post" action="index.php">
				<input type="submit" class="btn btn-primary" name="volver" value="Volver">
			</form>
			<?php
		}
	}
	include 'includes/footer.php';
?>