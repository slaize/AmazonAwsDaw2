<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>
    <div class="cien">
        <h1 class="tituloNoticia">Noticias NFL</h1>
        <div class="ochenta ochentaR">
            <div class="gridNoticiasListado">
                <?php foreach ($datos as $dato) { ?>
                    <?php $ruta = $_SESSION['home'] . "noticias/" . $dato->slug ?>
                    <div class="gridListado">
                        <div class="imagen">
                            <?php $imagen = $dato->url; ?>
                            <?php $imagen = substr($imagen, 2); ?>
                            <?php $res = ($dato->url != null) ? "/cms" . $imagen : $public . "img/logo.jpg"; ?>
                            <a href="<?php echo $ruta ?>"><img src="<?php echo $res ?>"></a>
                        </div>
                        <div class="textosListado">
                            <div class="contenedorTitulos">
                                <a href="<?php echo $ruta ?>" class="tituloListado"><?php echo $dato->titulo ?></a>
                            </div>
                            <p class="entradillaListado"><?php echo $dato->entradilla ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
<!--
    <div class="cien">
        <div class="ochenta">
            <div class="noticiasHome">

                <?php foreach ($datos as $dato) { ?>
                    <div class="gridListado">
                        <?php $ruta = $_SESSION['home']."noticias/" . $dato->slug?>
                        <a  href="<?php echo $ruta ?>"><div class="imagen">
                            <?php $imagen = $dato->url; ?>
                            <?php $imagen = substr($imagen, 2); ?>
                            <?php $res = ($dato->url != null) ? "/cms" . $imagen : $public . "img/logo.jpg"; ?>
                            <img src="<?php echo $res ?>">
                            </div></a>
                        <div class="textosListado">
                            <a class="tituloHome" href="<?php echo $ruta ?>"  ><?php echo $dato->titulo ?></a>
                            <p><?php echo $dato->entradilla ?></p>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
    -->
<?php
require("../view/partials/footerHome.php");
?>