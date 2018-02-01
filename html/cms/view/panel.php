<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
?>
<body>
<div id="logoPanel">

</div>
<div id="contenedor_menu">
    <ul id="menu">
        <li  class="listaMenu"><a  class="elementoMenu" href="#home">Inicio</a></li>
        <li  class="listaMenu"><a  class="elementoMenu"href="#news">Noticias</a></li>
        <li  class="listaMenu"><a  class="elementoMenu"href="#contact">Usuarios</a></li>
        <li  class="listaMenu" id="salir"><a  class="elementoMenu" href="#about">Salir  <i class="fas fa-sign-out-alt"></i></a></li>
    </ul>
</div>
