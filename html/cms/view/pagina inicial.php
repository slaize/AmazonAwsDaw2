<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
?>

<div id="logoPanel">
    <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">
</div>
<div id="transparente"></div>
<section class="cabecera">
    <div class="contenedor_principal">
        <div class="menu" id="menu">
            <ul>
                <li><a>Home</a></li>
                <li><a>Noticias</a></li>
                <li><a>Contacto</a></li>
            </ul>
        </div>
        <i id="burger" class="fas fa-bars"></i>
    </div>
</section>
<div class="cien">
    <div class="ochenta">
        <div class="noticiasHome">
            <img>
            <p>HOLA</p>
        </div>
        <div class="about">
            <p>About me </p>
        </div>
    </div>
</div>

<footer class="footerHome">
    <a>Politica de privacidad</a>
    <a>Aviso legal</a>
    <a>No Huddle © 2018</a>
</footer>
