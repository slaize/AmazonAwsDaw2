<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
?>
<body>
<div id="cajaLogin">
    <img id="avatar" src="<?php echo $public . "img/avatar.png"?>" alt="avatar">
    <p id="textoLogin"><?php echo $datos->mensaje ?></p>
    <form action="" method="post">
        <p class="usuarioContrasena">Usuario</p>
        <input type="text" name="usuario" id="usuario">
        <p class="usuarioContrasena">Contraseña</p>
        <input type="text" name="contrasena" id="contrasena">
        <input type="submit" name="acceder" value="acceder" id="botonLogin">
    </form>
</div>
