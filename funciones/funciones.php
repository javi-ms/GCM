<?php
	require_once 'clases/administrador.php';
	require_once 'clases/expcategorias.php';
	require_once 'clases/pregunta.php';
	require_once 'clases/experto.php';

	function comprobarVariablesSesion(){
		if(!isset($_SESSION['perfil']))
	        $_SESSION['perfil']="invitado";
	}

	function mostrarBotonCerrarSesion(){
		echo " <form method=\"post\" action=\"cerrarSesion.php\">";
        echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"cerrar\" value=\"Cerrar sesión\">";
        echo "</form>";
	}

	function mostrarBotonJugar(){
		echo " <form style=\"display: inline \" method=\"post\" action=\"jugar.php\">";
        echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"cerrar\" value=\"Jugar\">";
        echo "</form>";
	}


	function comprobarUsuario($usuario,$pass){
		$admin = administrador::singleton();
		$administrador=$admin->get_administrador($usuario,$pass);

		if(empty($administrador)){
			$exper= experto::singleton();
			$experto=$exper->get_experto_usuario($usuario,$pass);

			if(!empty($experto) && $experto['validada']==1){
				$_SESSION['perfil']="experto";
				$_SESSION['idExperto']=$experto['id'];
			}
		}

		else
			$_SESSION['perfil']="administrador";	
	}

	function mostrarMenuAdministrador(){
		echo "<h1>Menú de administración</h1>";
		echo "<h2>Expertos</h2>";
		echo "<br></br>";

		$exper= experto::singleton();
		$experto=$exper->get_todos_expertos();

		echo "<div class=\"table-responsive\">";
        echo "<table class=\"table table-striped table-bordered\">";
        echo "<thead style = \"color:#999; background-color: #333\">";
        echo "<th>Nombre</th><th>Usuario</th><th>Email</th>";
        echo "<th>Acciones</th>";
        echo "</thead>";
        echo "<tbody>";

		echo "<form method=\"get\" action=\"validarExperto.php\">";
        foreach ($experto as $key) {
          	echo "<tr><td>".$key['nombre']."</td>";
            echo "<td>".$key['usuario']."</td>";
          	echo "<td>".$key['email']."</td>";
          
          	if($key['validada']==0)
                echo "<td><a class=\"btn btn-primary\" href=\"validarExperto.php?indice=".$key['id']."\">Validar</a>";
            else
                echo "<td><a class=\"btn btn-primary disabled\" href=\"validarExperto.php?indice=".$key['id']."\">Validado</a>";


 			echo " <a class=\"btn btn-warning\" href=\"editarExperto.php?indice=".$key['id']."\">Editar</a>";
 			echo " <a class=\"btn btn-danger\" href=\"borrarExperto.php?indice=".$key['id']."\">Borrar</a>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</form>";
        echo "</tbody>";
        echo "</table>";
		echo "<br></br>";

        echo "<div id=\"cajaEnLinea\">";

		echo "<form method=\"post\" action=\"anadirCategoria.php\">";
        echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"anadirCategoria\" value=\"Añadir Categoría\">";
        echo "</form>";

	}

	function mostrarMenuExperto(){
		$exper= experto::singleton();
		$experto=$exper->get_experto($_SESSION['idExperto']);
		echo "<h1>Menú de experto</h1>";
		echo "<h2>Bienvenido ".$experto['nombre']."</h2>";
		echo "<br></br>";
        $pregun= pregunta::singleton();
		$pregunta=$pregun->get_ultimas_preguntas($_SESSION['idExperto']);

		echo "<div class=\"table-responsive\">";
        echo "<table class=\"table table-striped table-bordered\">";
        echo "<thead style = \"color:#999; background-color: #333\">";
        echo "<th>Pregunta</th>";
        echo "<th>Acciones</th>";
        echo "</thead>";
        echo "<tbody>";

        echo "<form method=\"get\" action=\"validarExperto.php\">";
        foreach ($pregunta as $key) {
          	echo "<tr><td>".$key['pregunta']."</td>";

 			echo "<td> <a class=\"btn btn-warning\" href=\"editarPregunta.php?indice=".$key['id']."\">Editar</a>";
 			echo " <a class=\"btn btn-danger\" href=\"borrarPregunta.php?indice=".$key['id']."\">Borrar</a>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</form>";
        echo "</tbody>";
        echo "</table>";
		echo "<br></br>";
		echo "<div id=\"cajaEnLinea\">";

		echo " <form method=\"post\" action=\"anadirPregunta.php\">";
        echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"anadir\" value=\"Añadir pregunta\">";
        echo "</form>";
	}

	function validarExperto($id){
		$experto = experto::singleton();
		$exp = $experto->validar_exp($id);
	}

	function borrarExperto($id){
		$experto = experto::singleton();
		$exp = $experto->borrar_exp($id);
	}

	function borrarExpertoCategoria($id){
		$experCat= expcategorias::singleton();
		$expertoCategoria=$experCat->borrar_experto_categoria($id);
	}

	function insertarPregunta($id,$cadena,$objeto,$tipoObjeto,$categorias,$niveles,$idExp){
		$pregunta2 = pregunta::singleton();
		$preg2 = $pregunta2->ins_pregunta($id,$cadena,$objeto,$tipoObjeto,$categorias,$niveles,$idExp);
	}

	function insertarRespuesta($id,$respuesta,$valida)
	{
		$respuestas = respuestas::singleton();
		$respuestas->ins_respuesta($id,$respuesta,$valida);
	}
?>