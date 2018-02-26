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
<?php
require("../view/partials/footerHome.php");
?>