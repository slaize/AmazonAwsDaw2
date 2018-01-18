<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 4: Modelo Vista Controlador</h2>";

// Incluyo los archivos necesarios
require("./controller/ContactoController.php");
require("./model/Contacto.php");

//Instancio el controlador
$controller = new ContactoController;

// Ejecuto el metodo por defecto del controlador
$controller->index();
