<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>
    <div class="cien">
        <div class="ochenta">
            <div class="home">
                <?php foreach ($datos as $dato) { ?>
                <div class="gridHome">
                    <?php $ruta = $_SESSION['home']."noticias/" . $dato->slug?>
                    <a href="<?php echo $ruta ?>" ><div class="imagen">
                        <?php $imagen = $dato->url; ?>
                        <?php $imagen = substr($imagen,2); ?>
                        <?php $res = ($dato->url != null) ? "/cms".$imagen : $public . "img/logo.jpg"; ?>
                       <img src="<?php echo $res ?>"/>
                    </div></a>
                    <div class="textos">
                        <a href="<?php echo $ruta ?>"  class="tituloHome"><?php echo $dato->titulo ?></a>
                        <p class="entradillaHome"><?php echo $dato->entradilla ?></p>
                    </div>
                </div>
                <?php } ?>

                <a href="<?php echo $_SESSION['home'] . "noticias" ?>" class="verMasHome">Ver más <i class="far fa-plus-square"></i></a>

            </div>
            <div class="aboutUs">
                <h2>Sobre mí</h2>
                <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">

                <p> Bienvenido a mi web, con ella esperaba realizar un proyecto que me hacia mucha ilusion sobre un deporte que no
                es muy popular aquí como es el fútbol americano, la página esta en constante mejora e
                ira actualizandose poco a poco con las principales noticias del mundo NFL.</p>

            </div>
        </div>
    </div>

<?php
require("../view/partials/footerHome.php");
?>