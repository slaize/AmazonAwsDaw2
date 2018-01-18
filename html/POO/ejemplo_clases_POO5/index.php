<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 5: Modelo Vista Controlador con 'Autoload'</h2>";

// Defino la funcion que autocargara las clases cuando se instancien
spl_autoload_register('autoload');


function autoload($clase, $dir = null)
{

    //Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)) {
        $dir = realpath(dirname(__FILE__));
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {
        //Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir . "/" . $file) AND substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        } //Si es archivo y el nombre coincide con la clase
        else if (is_file($dir . "/" . $file) AND $file == $clase . ".php") {
            //echo $clase.""; //para ver cuales ha cargado
            require($dir . "/" . $file);
        }

    }

}

// Instancio el controlador
$controller = new ContactoController;

// Ejecuto el metodo por defecto del controlador
$controller->index();
