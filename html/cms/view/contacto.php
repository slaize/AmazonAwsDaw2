<?php
// Localizamos la base de la url
$public = '/cms/public/';
//Llamo a la cabecera
require("../view/partials/header.php");
require("../view/partials/menuHome.php");
?>
    <div class="cien">
        <section id="contact" class="content-section text-center cajonContacto">
            <div class="container contenedor_contacto">
                <h2> <i class="fas fa-football-ball"></i> Contactanos</h2>
                <p>Si necesitas contactar con nostros puedes usar el formulario que hay justo debajo o hacerlo a traves de
                nuestras redes sociales</p>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 cajas">
                        <form class="form-horizontal ">
                            <div class="form-group">
                                <input type="text" class="form-control cajasTextos" id="exampleInputName2" placeholder="Nombre completo">
                                <input type="email" class="form-control cajasTextos" id="exampleInputEmail2"
                                       placeholder="Correo electrónico">
                                <textarea class="form-control cajasTextos" placeholder="Introduce aquí tu consulta"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default" id="botonContacto">Enviar</button>
                        </form>

                    </div>
                </div>
                <hr>
                <h3>Nuestras redes sociales</h3>
                <ul class="list-inline banner-social-buttons ">
                    <li><a href="#" class="btn btn-default btn-lg redesSociales"><i class="fab fa-twitter"></i> <span
                                    class="network-name"> Twitter</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg redesSociales"><i class="far fa-envelope"></i><span
                                    class="network-name"> Correo Electrónico</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg redesSociales"><i class="fab fa-instagram"></i><span
                                    class="network-name"> Instagram</span></i></a></li>
                </ul>
            </div>
        </section>
    </div>

<?php require("../view/partials/footerHome.php"); ?>