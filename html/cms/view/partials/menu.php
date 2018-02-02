<header>
    <div id="logoPanel">
        <img id="logo" src="../img/logo.jpg" alt="logo">
    </div>
    <div id="contenedor_menu">
        <ul id="menu">
            <li class="listaMenu"><a  class="elementoMenu" href="<?php echo $_SESSION['home']?>panel">Inicio</a></li>
            <li class="listaMenu"><a  class="elementoMenu" href="">Noticias</a></li>
            <li class="listaMenu"><a  class="elementoMenu" href="<?php echo $_SESSION['home']?>panel/usuarios">Usuarios</a></li>
            <li class="listaMenu" id="salir"><a  class="elementoMenu"  href="<?php echo $_SESSION['home']?>panel/salir">Salir  <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>
</header>