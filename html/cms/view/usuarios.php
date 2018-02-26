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
    <div class="noticiasPanel">
        <a id="botonNuevoUser" class="btn btn-primary" href="<?php echo $_SESSION['home'] ?>panel/usuarios/crear"
           role="button">Añadir
            usuario <i class="fas fa-plus"></i></a>
        <div class="content_section listado">
            <ul class="row titulo">
                <li class="col-9"><i class="fas fa-user"></i>&nbsp; Usuarios</li>
                <li class="col-3 derecha"><i class="fas fa-cogs"></i>&nbsp; Acciones</li>
            </ul>
            <?php foreach ($datos as $dato) { ?>
                <ul class="row item">
                    <li class="col-9">
                        <b><p><?php echo $dato->usuario ?></p></b>

                        <hr>
                    </li>
                    <li class="col-3 derecha">
                        <?php $ruta = $_SESSION['home'] . "panel/usuarios/editar/" . $dato->id ?>
                        <a href="<?php echo $ruta ?>" title="editar"><i class="fas fa-pencil-alt"></i></a>
                        <?php
                        $color = ($dato->activo == 1) ? 'activo' : 'inactivo';
                        $texto = ($dato->activo == 1) ? 'desactivar' : 'activar';
                        //Ponemos la ruta para activar o descativar los usuarios
                        $ruta = $_SESSION['home'] . "panel/usuarios/" . $texto . "/" . $dato->id;
                        ?>
                        <a href="<?php echo $ruta ?>" class="<?php echo $color ?>" title="<?php echo $texto ?>"><i
                                    class="far fa-check-circle"></i></a>
                        <?php $ruta = $_SESSION['home'] . "panel/usuarios/borrar/" . $dato->id ?>
                        <a href="<?php echo $ruta ?>" title="borrar" id="borrarUsuario"
                           onclick="return confirm('¿Estás seguro?')"><i class="fas fa-trash"></i></a>
                        <hr>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>

<?php require("../view/partials/footer.php"); ?>