<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>

    <div class="cien">
        <div class="ochenta">
            <div class="noticiaCompleta">
                <?php foreach ($datos as $dato) { ?>
                <div class="imagenNoticiaCompleta">
                    <?php $imagen = $dato->url; ?>
                    <?php $imagen = substr($imagen, 2); ?>
                    <?php $res = ($dato->url != null) ? "/cms" . $imagen : "" ?>
                    <img src="<?php echo $res ?>">
                </div>

                <h1><?php echo $dato->titulo ?></h1>
                <p><?php echo $dato->texto ?></p>

            </div>
    <?php } ?>
        </div>
        <div id="stop" class="scrollTop">
            <span><a href=""><i class="fas fa-angle-up"></i></a></span>
        </div>
    </div>

<?php
require("../view/partials/footerHome.php");