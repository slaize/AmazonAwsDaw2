<?php

// $1$qo3lzJOl$QQBRGwezo9Hcs4Xr8Pi24/
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menu.php");
?>
<h1>Edición de usuario</h1>

<div class="container" id="cajonEditar">
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="nombreEditar" value="<?php echo $datos->usuario ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre completo</label>
            <input type="text" class="form-control" name="nombre" id="nombreUsuario" value="<?php echo $datos->nombre_completo ?>">
        </div>
        <div class="form-check checkEditar" id="cambiaClave">
            <input type="checkbox" class="form-check-input" name="cambiarClave" id="activoCambioClave">
            <label class="form-check-label" for="cambioclave">Marcar para cambiar la clave</label>
        </div>
        <div class="form-group password">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="clave" id="claveEditar">
        </div>
        <div class="form-check checkEditar">
            <?php $noticias= ($datos->noticias == 1) ?  'checked' : ""; ?>
            <input type="checkbox" class="form-check-input" name="noticias" id="activoNoticias"<?php echo $noticias ?>>
            <label class="form-check-label" for="noticiasCheck">Noticias</label>
        </div>
        <div class="form-check checkEditar">
            <?php $usuarios= ($datos->usuarios == 1) ?  'checked' : ""; ?>
            <input type="checkbox" class="form-check-input" name="usuarios" id="usuariosEditar" <?php echo $usuarios ?>>
            <label class="form-check-label" for="activoUsuarios">Usuarios</label>
        </div>

        <div id="botonesEditar">
        <a type="button" name="volver" id="volverEditar" class="btn btn-primary"   href="<?php echo $_SESSION['home'] ?>panel/usuarios">Volver</a>
        <button type="submit" name="guardar" id="guardarEditar" value="Guardar" class="btn btn-primary">Guardar</i></button>
        </div>
    </form>
</div>
