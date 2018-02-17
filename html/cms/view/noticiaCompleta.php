<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>

    <div class="cien">
        <div class="ochenta">
            <div class="noticiaCompleta">
                <?php foreach ($datos as $dato) { ?>
                <div class="imagenNoticiaCompleta">
                    <?php $imagen = $dato->url; ?>
                    <?php $imagen = substr($imagen, 2); ?>
                    <?php $res = ($dato->url != null) ? "/cms" . $imagen : "" ?>
                    <img src="<?php echo $res ?>">
                </div>

                <h1><?php echo $dato->titulo ?></h1>
                <p><?php echo $dato->texto ?></p>


                <!--
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a sollicitudin massa, vitae ornare
                    turpis. Phasellus sed tempus turpis, eu vestibulum est. Praesent ligula lectus, porta ac lacus
                    pellentesque, ornare maximus nibh. Quisque id sapien non eros lacinia rhoncus. Maecenas blandit
                    laoreet tellus, a auctor leo vehicula sodales. Nullam pellentesque orci at lacus scelerisque
                    egestas. Suspendisse potenti. Mauris sed tortor id magna ullamcorper fermentum. Phasellus cursus
                    justo eu dapibus luctus.</p>

                <p> Vivamus ullamcorper sollicitudin ipsum at elementum. Praesent sed dui eleifend, dignissim dolor nec,
                    consectetur dolor. Etiam consectetur pharetra urna, a condimentum augue mollis ut. Praesent et nibh
                    venenatis, posuere velit sit amet, feugiat velit. Curabitur at odio in sem aliquam placerat non
                    fringilla sem. Praesent in vehicula magna. Quisque porttitor sed ex a viverra. Proin ut bibendum
                    metus, ut gravida diam. Sed ultrices justo mi, porta iaculis justo convallis a. Nunc malesuada
                    bibendum neque ac dapibus. Praesent sagittis scelerisque gravida. </p>

                <p> Vivamus vestibulum leo euismod ultrices tempus. Ut mauris nulla, rhoncus id varius non, facilisis a
                    sem. Nam risus neque, blandit sit amet rutrum ac, dapibus in metus. Aliquam metus felis, vehicula
                    non diam ut, tincidunt dignissim ligula. Etiam auctor tempor nibh, nec consectetur orci porta eget.
                    In viverra finibus libero, et vestibulum tortor tincidunt ut. Aliquam a lacus at tortor commodo
                    malesuada. Curabitur commodo nunc velit, a euismod felis tempus sed. Praesent porta ex et turpis
                    facilisis, nec accumsan urna tristique. </p>

                <p> Sed eu tincidunt est. In luctus lectus ac augue egestas, ut sollicitudin libero viverra. Duis nulla
                    eros, consectetur a ante non, eleifend fermentum elit. Maecenas et purus sed risus vehicula
                    pulvinar. Sed hendrerit sapien a turpis dignissim congue pretium dictum lectus. Integer pellentesque
                    ultricies velit sed blandit. Nam ut arcu lacus. Suspendisse at pretium enim. Class aptent taciti
                    sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent suscipit lacinia
                    lectus, eu gravida sem tincidunt non. </p>

                <p> Vivamus fermentum, sem eu laoreet bibendum, metus libero commodo dui, sed efficitur quam quam sed
                    velit. Nullam eu libero nec dolor porta faucibus. Cras viverra lectus sit amet dignissim egestas.
                    Cras sit amet nisl ut erat fermentum consectetur eget ut est. Etiam ac scelerisque neque. In eget
                    euismod odio. Praesent lectus ipsum, dictum at libero ac, consequat viverra turpis. Nulla convallis,
                    nisi sed mattis laoreet, justo lacus sagittis eros, id cursus est est nec est. In hac habitasse
                    platea dictumst. Phasellus nec sapien velit. Phasellus congue auctor odio, eu gravida ligula
                    vulputate sit amet. Proin ut tempor justo. Donec convallis vel mi sed malesuada. Vestibulum
                    fermentum est quis sodales lobortis. </p> -->

            </div>
    <?php } ?>
        </div>
    </div>

<?php
require("../view/partials/footerHome.php");