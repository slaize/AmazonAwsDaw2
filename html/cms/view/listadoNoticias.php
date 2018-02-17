<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>


    <div class="cien">
        <div class="ochenta">
            <div class="noticiasHome">

                <?php foreach ($datos as $dato) { ?>
                    <div class="gridListado">
                        <div class="imagen">
                            <?php $imagen = $dato->url; ?>
                            <?php $imagen = substr($imagen, 2); ?>
                            <?php $res = ($dato->url != null) ? "/cms" . $imagen : $public . "img/logo.jpg"; ?>
                            <img src="<?php echo $res ?>">
                        </div>
                        <div class="textosListado">
                            <?php $ruta = $_SESSION['home'] . "/noticias/" . $dato->id ?>
                            <a href="<?php echo $ruta ?>"  class="tituloHome"><?php echo $dato->titulo ?></a>
                            <p><?php echo $dato->entradilla ?></p>
                        </div>
                    </div>
                <?php } ?>

                <!--
            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>TituloTituloTitulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div>

            <div class="gridNoticias">
                <div class="imagen">
                    <img src="<?php echo $public . "img/logo.jpg" ?>">
                </div>
                <div class="textos">
                    <h2>Titulo</h2>
                    <p>Entradilla</p>
                </div>
            </div> -->


            </div>
        </div>
    </div>
<?php
require("../view/partials/footerHome.php");
?>