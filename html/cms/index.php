<?php
namespace App;

use App\Controller\UsuarioController;

// 🡇  Defino la funcion que autocargara las clases cuando se instancien
spl_autoload_register('App\autoload');


function autoload($clase, $dir = null)
{

    // 🡇 Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)) {
        $dir = realpath(dirname(__FILE__));
    }

    // 🡇  Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {
        // 🡇 Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir . "/" . $file) AND substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        } // 🡇 Si es archivo y el nombre coincide con la clase (quitando el namespace)
        else if (is_file($dir . "/" . $file) AND $file == substr(strrchr($clase, "\\"), 1) . ".php") {
            require($dir . "/" . $file);
        }
    }
}

// 🡇  Instancio el controlador
$controller = new UsuarioController;

// 🡇  Ejecuto el metodo por defecto del controlador
$controller->index();
