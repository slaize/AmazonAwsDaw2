<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
?>

<div class="container" id="cajaLogin">
    <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">
    <p id="textoLogin"><?php echo $datos->mensaje ?></p>
    <form action="" method="post">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
            <input  type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fas fa-key"></i></span>
            <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña">
        </div>

        <div class="row">
            <input type="submit" name="acceder" value="Acceder" id="botonLogin" class="btn btn-primary"></button>
        </div>
        </form>
</div>



<?php require("../view/partials/footer.php"); ?>