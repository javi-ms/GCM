<?php
	session_start();
	$_SESSION['perfil']="invitado";
	header("Location: index.php");
?>