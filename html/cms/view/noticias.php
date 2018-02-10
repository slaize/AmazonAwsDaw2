<?php
/**/
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menu.php");
//Llamo a los mensajes
require("../view/partials/mensajes.php");
?>
<a id="botonNuevaNoticia" class="btn btn-primary" href="<?php echo $_SESSION['home'] ?>panel/noticias/crear"
   role="button">Añadir noticias <i class="fas fa-plus"></i></a>
<div class="content_section listadoNoticias">
    <ul class="row titulo">
        <li class="col-3 centro"><i class="far fa-newspaper"></i>&nbsp;Titulo</li>
        <li class="col-3 centro">Fecha Alta</li>
        <li class="col-3 centro">Fecha Publicacion</li>
        <li class="col-3 derecha"><i class="fas fa-cogs"></i>&nbsp; Acciones</li>
    </ul>
    <?php foreach ($datos as $dato) { ?>
        <ul class="row item">
            <li class="col-3 centro">
                <a href=""><?php echo $dato->titulo ?></a>
                <hr>
            </li>
            <li class="col-3 centro">
                <?php $t = strtotime($dato->fecha_alta); ?>
                <a href=""><?php echo date('d/m/y H:i:s', $t) ?></a>
                <hr>
            </li>
            <li class="col-3 centro">
                <a href=""><?php echo $dato->fecha_publicacion ?></a>
                <hr>
            </li>
            <li class="col-3">
                <?php $ruta = $_SESSION['home'] . "panel/noticias/editarN/" . $dato->id ?>
                <a href="<?php echo $ruta ?>" title="editar"><i class="fas fa-pencil-alt"></i></a>

                <?php
                $color = ($dato->home == 1) ? 'activo' : 'inactivo';
                $texto = ($dato->home == 1) ? 'homedesactivar' : 'homeactivar';
                $title = ($dato->home == 1) ? 'home desactivar' : 'home activar';
                //Ponemos la ruta para activar o descativar los usuarios
                $ruta = $_SESSION['home'] . "panel/noticias/" . $texto . "/" . $dato->id;
                ?>
                <a href="<?php echo $ruta ?>" title="<?php echo $title ?>" class="<?php echo $color ?>"><i class="fas fa-home"></i></i></a>

                <?php
                $color = ($dato->activa == 1) ? 'activo' : 'inactivo';
                $texto = ($dato->activa == 1) ? 'desactivar' : 'activar';
                //Ponemos la ruta para activar o descativar los usuarios
                $ruta = $_SESSION['home'] . "panel/noticias/" . $texto . "/" . $dato->id;
                ?>
                <a href="<?php echo $ruta ?>" class="<?php echo $color ?>" title="<?php echo $texto ?>"><i
                            class="far fa-check-circle"></i></a>

                <?php $ruta = $_SESSION['home'] . "panel/noticias/borrar/" . $dato->id ?>
                <a href="<?php echo $ruta ?>" title="borrar" id="borrarUsuario"
                   onclick="return confirm('¿Estás seguro?')"><i class="fas fa-trash"></i></a>
                <hr>
            </li>
        </ul>
    <?php } ?>

</div>
<script>
    ocultarFooterPanel();
</script>