<?php
namespace App;
session_start();

use App\Controller\UsuarioController;

// Localizamos la base de la url
$public = '/cms/public/';

//Llamo a la cabecera
require("../view/partials/header.php");


// Defino la funcion que autocargara las clases cuando se instancien
spl_autoload_register('App\autoload');


function autoload($clase, $dir = null)
{

    //Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)) {
        $dirname = str_replace('/public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {
        //Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir . "/" . $file) AND substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        } //Si es archivo y el nombre coincide con la clase (quitando el namespace)
        else if (is_file($dir . "/" . $file) AND $file == substr(strrchr($clase, "\\"), 1) . ".php") {
            require($dir . "/" . $file);
        }
    }
}

// Compruebo que ruta me estan pidiendo
$home = '/cms/public/index.php/';
$final_url = str_replace($home, '', $_SERVER["REQUEST_URI"]);

//Enruto a panel
if($final_url == 'panel'){
    // Instancio el controlador
    $controller = new UsuarioController;

    // Le mando al panel de acceso
    $controller->acceso();
}
/*
// Instancio el controlador
$controller = new UsuarioController;

// Ejecuto el metodo por defecto del controlador
$controller->index();
*/  //Dentro esta la llamada al usuario controller

//Llamo al pie
require("../view/partials/footer.php");