<?php
	session_start();
	require_once 'clases/pregunta.php';
	require_once 'clases/respuestas.php';

	include 'includes/header.php';
	include 'includes/body.php';

	$pregunta = pregunta::singleton();
	$datoPregunta = $pregunta->get_pregunta_aleatoria();

	$respuestas = respuestas::singleton();
	$datoRespuestas = $respuestas->get_respuestas($datoPregunta['id']);

	if(isset($_SESSION['respuesta'])){
    	echo "<br/><br/>";
    	if($_SESSION['respuesta'])
    		echo "<div class=\"alert alert-success\">Respuesta correcta</div>";
    	else
    		echo "<div class=\"alert alert-danger\">Respuesta incorrecta</div>";
    }

	switch($datoPregunta['tipoObjeto']){
		case 'Imagen':
			echo '<img style = "height: cover; width: 300px" src="multimedia/'.$datoPregunta['Objeto'].'">';
			echo "<br/><br/>";
			break;
		case 'Vídeo':
			echo '<video width="300" height="cover" controls><source src="multimedia/'.$datoPregunta['Objeto'].'"></video>';
			echo "<br/><br/>";
			break;
		case 'Audio':
			echo '<audio controls><source src="multimedia/'.$datoPregunta['Objeto'].'"></audio>';
			echo "<br/><br/>";
			break;
	}

    echo "<h3>".$datoPregunta['pregunta']."</h3><br/><br/>";

    foreach ($datoRespuestas as $key => $value) {
    	echo "<a href=\"comprobarResultado.php?valor=".$value."&id=".$datoPregunta['id']."\" class=\"btn btn-primary\">".$value."<br/>"."</a>";
    	echo "<br/><br/>";
    }?>

	<br/><br/>

    <a class="btn btn-danger" href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
   

	<?php

    include 'includes/footer.php';
?>