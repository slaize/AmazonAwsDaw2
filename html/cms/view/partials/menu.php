<?php
// Localizamos la base de la url
$public = '/cms/public/';

?>
<div id="logoPanel">
    <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">
</div>
<nav class="navbar navbar-fixed-top navbar-toggleable-sm navbar-inverse bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand" href="#"><i class="fas fa-football-ball fa-spin"></i></span>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item listaMenu">
                <a class="nav-link elementoMenu" href="<?php echo $_SESSION['home'] ?>panel">Inicio</a>
            </li>
            <li class="nav-item listaMenu">
                <a class="nav-link elementoMenu"  href="<?php echo $_SESSION['home'] ?>panel/noticias">Noticias</a>
            </li>
            <?php if($_SESSION['usuarios']){ ?>
            <li class="nav-item listaMenu">
                <a class="nav-link elementoMenu" href="<?php echo $_SESSION['home'] ?>panel/usuarios">Usuarios</a>
            </li>
            <?php } ?>
            <li class="nav-item listaMenu">
                <a class="nav-link elementoMenu" href="<?php echo $_SESSION['home'] ?>panel/salir">Salir  <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>