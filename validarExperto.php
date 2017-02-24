<?php
	session_start();
	include 'funciones/funciones.php';
	include 'includes/header.php';
	include 'includes/body.php';

	if(isset($_GET['indice']))
		validarExperto($_GET['indice']);
		
	header("Location: index.php");
	
?>