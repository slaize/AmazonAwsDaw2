<?php
/**/
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menu.php");
//Llamo a los mensajes
require("../view/partials/mensajes.php");
?>

<div class="container" id="cajonSubida">
    <h1>Subida de foto de la noticia</h1>
    <p id="avisoSubida">Solo se puede subir una foto con formato ".jpeg" o ".png"</p>
    <div class="form-group subidaFichero">
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="hidden" name="size" value="10000000000" />
        <input type="file" id="cajaSubida" name="archivo"/>
        <input type="submit" id="subirFoto" value="Subir archivo" name="subir"/>
    </form>
    </div>
        <a type="button" name="volver" id="volverSubirFoto" class="btn btn-primary"
           href="<?php echo $_SESSION['home'] ?>panel/noticias">Volver</a>
</div>