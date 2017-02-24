<?php
	session_start();

	include 'includes/header.php';
	include 'includes/body.php';
    include 'funciones/funciones.php';

    comprobarVariablesSesion();

    if(isset($_POST['enviar']) && !empty($_POST['usuario']) && !empty($_POST['contrasenia'])) {

        comprobarUsuario($_POST['usuario'],$_POST['contrasenia']);
    }


    if($_SESSION['perfil']=="invitado"){?>
    	<div class="col-lg-1">
    		<img style = "height: cover; width: 100px" src="multimedia/logo.jpg"></img>
    	</div>

    	<div class="col-lg-10">
    		<h1>SabioGC</h1></p><br/>
    	</div>
    	<div class="col-lg-2">
    	</div>
    	<div class="col-lg-12">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <label>Usuario </label> <input type="text" name="usuario"></br></br>
        <label>Contraseña </label> <input type="password" name="contrasenia"><br/><br/>
        <div id="cajaEnLinea">
        <input type="submit" class="btn btn-primary" name="enviar" value="Login">
        </form>

        <form style ="display: inline;" method="post" action="registro.php">
        <input type="submit" class="btn btn-primary" name="registro" value="Registro">
        </form>

        <?php
    }

    if($_SESSION['perfil']=="administrador"){
        mostrarMenuAdministrador();
    }

    if($_SESSION['perfil']=="experto"){
        mostrarMenuExperto();
    }

    if($_SESSION['perfil']!="invitado"){
        mostrarBotonCerrarSesion();
    }

    mostrarBotonJugar();

    echo "</div></div>";
    echo "<br/><br/>";

    include 'includes/footer.php';
?>