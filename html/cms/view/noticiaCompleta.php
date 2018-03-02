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
                    <div class="contenidoNoticiaCompleta">
                        <div class="tituloNoticia">
                            <h1><?php echo $dato->titulo ?></h1>
                        </div>
                        <div class="contenidoNoticia">
                            <p><?php echo html_entity_decode( $dato->texto) ?></p> <!-- 🠴 Decodifico el texto filtrado en la BBDD -->
                        </div>
                    </div>

                <?php } ?>
            </div>
            <div id="stop" class="scrollTop">
                <span><a href=""><i class="fas fa-angle-up"></i></a></span>
            </div>
        </div>
    </div>

<?php
require("../view/partials/footerHome.php");