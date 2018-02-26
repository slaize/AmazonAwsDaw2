<div id="logoPanel">
    <a href="<?php echo $_SESSION['home'] ?>">
    <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">
    </a>
</div>
<div id="transparente"></div>
<section class="cabecera">
    <div class="contenedor_principal">
        <div class="menu" id="menu">
            <ul>
                <li><a href="<?php echo $_SESSION['home'] ?>">Home</a></li>
                <li><a href="<?php echo $_SESSION['home'] . "noticias" ?>">Noticias</a></li>
                <li><a href="<?php echo $_SESSION['home'] . "contacto" ?>">Contacto</a></li>
            </ul>
        </div>
        <i id="burger" class="fas fa-bars"></i>
    </div>
</section>
