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
                <div class="gridHome">
                    <div class="imagen">
                        <img src="<?php echo $public . "img/logo.jpg" ?>">
                    </div>
                    <div class="textos">
                        <h2>Titulo</h2>
                        <p>Entradilla</p>
                    </div>
                </div>

                <div class="gridHome">
                    <div class="imagen">
                        <img src="<?php echo $public . "img/logo.jpg" ?>">
                    </div>
                    <div class="textos">
                        <h2>Titulo</h2>
                        <p>Entradilla</p>
                    </div>
                </div>
                <div class="gridHome">
                    <div class="imagen">
                        <img src="<?php echo $public . "img/logo.jpg" ?>">
                    </div>
                    <div class="textos">
                        <h2>Titulo</h2>
                        <p>Entradilla</p>
                    </div>
                </div>
                <div class="gridHome">
                    <div class="imagen">
                        <img src="<?php echo $public . "img/logo.jpg" ?>">
                    </div>
                    <div class="textos">
                        <h2>Titulo</h2>
                        <p>Entradilla</p>
                    </div>
                </div>

                <div class="gridHome">
                    <div class="imagen">
                        <img src="<?php echo $public . "img/logo.jpg" ?>">
                    </div>
                    <div class="textos">
                        <h2>Titulo</h2>
                        <p>Entradilla</p>
                    </div>
                </div>

                <a href="" class="verMasHome">Ver más</a>

            </div>
            <div class="aboutUs">
                <h2>About us</h2>
                <img id="logo" src="<?php echo $public . "img/logo.jpg" ?>" alt="logo">
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula lorem sed ante iaculis
                    commodo. Fusce in nibh ac diam luctus tempus sed vitae orci. Nam pulvinar orci eu sagittis ultrices.
                    Pellentesque sit amet turpis et libero luctus lacinia. Morbi at magna at justo imperdiet vehicula.
                    Phasellus semper tortor ligula, a rhoncus ligula pellentesque vitae. In blandit, felis sed
                    ullamcorper bibendum, purus ante luctus turpis, vel posuere lectus diam nec ex. Morbi lobortis felis
                    non fringilla consequat. Pellentesque lobortis elementum erat, id semper lorem congue non. Aliquam
                    elementum turpis vel urna aliquam, id blandit quam aliquam. Mauris efficitur ante rutrum nisl
                    efficitur semper. Phasellus eu facilisis urna. Phasellus quis ipsum sagittis, mollis eros non,
                    sodales elit. Proin porta ornare eros, sit amet dapibus risus. Curabitur et nisi diam.</p>
                <p> Sed id volutpat odio. In ultrices, sapien non maximus gravida, enim ex dictum neque, vel luctus
                    risus nibh eu mi. In viverra elit pellentesque lorem pellentesque, id aliquet lectus suscipit.
                    Integer est ante, tincidunt mattis metus eu, venenatis ultrices arcu. Aenean leo leo, pellentesque
                    in velit vitae, semper venenatis felis. Donec feugiat ac urna vitae sodales. Vivamus eleifend
                    facilisis ullamcorper.</p>
                </p>
            </div>
        </div>
    </div>

<?php
require("./partials/footerHome.php");