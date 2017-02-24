<?php
	session_start();
	require_once 'clases/expcategorias.php';
    include 'clases/niveles.php';
	include 'includes/header.php';
	include 'includes/body.php';
    include 'funciones/funciones.php';

    if(!isset($_POST['anadir']))
		header("Location: index.php");
	else{
		$experCat= expcategorias::singleton();
  		$expertoCategorias = $experCat->get_experto_categorias($_SESSION['idExperto']);
        $niveles = niveles::singleton();
        $nivel = $niveles->get_niveles();
		?>
    	<h1>Nueva pregunta</h1>
    	
    	<br/>
    	<form method="post" action="nuevaPregunta.php" enctype="multipart/form-data">
			<label>Pregunta: </label>
			<input type="text" name="pregunta"><br/><br/>
			<label>Categoría: </label>
			<select class="custom-select" name="categorias[]">
          	<?php
          	foreach ($expertoCategorias as $key) {
            	echo "<option value=\"".$key['categoria']."\">".$key['categoria']."</option>";
          	}
          	?>
        	</select>
            <label>Nivel</label>
            <select class="custom-select" name="niveles[]">
            <?php
            foreach ($nivel as $key) {
              echo "<option value=\"".$key['nivel']."\">".$key['nivel']."</option>";
            }
            ?>
            </select>
            
            <label>Tipo</label>
            <select class="custom-select" name="tipoObjeto[]">
                <option value="" selected>Sólo texto</option>
                <option value="Imagen">Imagen</option>
                <option value="Video">Video</option>
                <option value="Sonido">Sonido</option>
            </select>
            <label>Fichero</label>
            <input type="file" name="uploadedfile">
            <br></br>
            <h2>Respuestas</h2>
            <br></br>
            <label>Respuesta 1:</label>
            <input type="text" name="respuesta1">
            <input type="checkbox" name="check1">
            <label>Válida</label>
            <br></br>
            <label>Respuesta 2:</label>
            <input type="text" name="respuesta2">
            <input type="checkbox" name="check2">
            <label>Válida</label>
            <br></br>
            <label>Respuesta 3:</label>
            <input type="text" name="respuesta3">
            <input type="checkbox" name="check3">
            <label>Válida</label>
            <br></br>
            <label>Respuesta 4:</label>
            <input type="text" name="respuesta4">
            <input type="checkbox" name="check4">
            <label>Válida</label>
            <br></br>
            <br></br>
            <input type="submit" class="btn btn-primary" name="enviar" value="Añadir">
        </form>
        <form style="display: inline;" method="post" action="index.php">
            <input type="submit" class="btn btn-primary" name="volver" value="Cancelar">
        </form>
    <?php
    }
    include 'includes/footer.php';
?>