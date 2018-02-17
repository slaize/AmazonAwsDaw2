<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menu.php");
?>
<div class="ochenta">
    <div id="main">
        <div id="d1">
            <p><i class="far fa-newspaper periodicoLogo"></i></p>
            <?php $ruta = $_SESSION['home'] . "panel/noticias" ?>
            <a href="<?php echo $ruta ?>" class="linkInicioPanel"> Noticias</a>
        </div>
        <?php if($_SESSION['usuarios']){ ?>
        <div id="d2">
            <p><i class="fas fa-users periodicoLogo"></i></p>
            <?php $ruta = $_SESSION['home'] . "panel/usuarios" ?>
            <a  href="<?php echo $ruta ?>" class="linkInicioPanel"> Usuarios</a>
        </div>
        <?php } ?>
    </div>
</div>

<?php require("../view/partials/footer.php"); ?>