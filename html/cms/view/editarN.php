<?php
// $1$qo3lzJOl$QQBRGwezo9Hcs4Xr8Pi24/
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/headerWysiwig.php");
require("../view/partials/menu.php");
?>

<h1>Edición de noticias</h1>
<div class="container" id="cajonEditar">
    <form method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="exampleInputEmail1">Tìtulo</label>
            <input type="text" class="form-control" name="titulo" id="nombreEditar"
                   value="<?php echo $datos->titulo ?>">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Entradilla</label>
            <textarea class="form-control" rows="2" name="entradilla"
                      id="textoEntradilla"> <?php echo $datos->entradilla ?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Texto</label>
            <textarea class="form-control" rows="10" id="texto" name="texto"><?php echo $datos->texto ?></textarea>
            <script type="text/javascript">
                tinyMCE.init({
                    theme: "advanced",
                    theme_advanced_toolbar_location: "top",
                    theme_advanced_toolbar_align: "left",
                    mode: "exact",
                    elements: "#texto"
                });
            </script>

        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Autor</label>
            <input type="text" class="form-control" name="autor" id="claveEditar" value="<?php echo $_SESSION['nombre_completo'] ?>" disabled>
        </div>

        <div id="botonesEditar">
            <a type="button" name="volver" id="volverEditar" class="btn btn-primary"
               href="<?php echo $_SESSION['home'] ?>panel/noticias">Volver</a>
            <button type="submit" name="guardar" id="guardarEditar" value="Guardar" class="btn btn-primary">
                Guardar</i></button>
        </div>


    </form>
</div>
