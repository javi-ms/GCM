<?php
	session_start();
	require_once 'clases/respuestas.php';

	include 'includes/header.php';
	include 'includes/body.php';

	if(!isset($_GET['valor']))
		header("Location: jugar.php");

	else{
		$respuestas = respuestas::singleton();

		$comprobarRespuestas= $respuestas->comprobar_respuesta($_GET['id'],$_GET['valor']);

		if($comprobarRespuestas['valida']==0)
			$_SESSION['respuesta']=false;

		else
			$_SESSION['respuesta']=true;
	}

	header("Location: jugar.php");
?>

