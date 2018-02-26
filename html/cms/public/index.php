<?php

namespace App;
session_start();

use App\Controller\UsuarioController;
use App\Controller\NoticiaController;
use App\Controller\AppController;

// 🡇 Localizamos la base de la url
$public = '/cms/public/';

// 🡇 Llamo a la cabecera
require("../view/partials/header.php");

// 🡇 Defino la funcion que autocargara las clases cuando se instancien
spl_autoload_register('App\autoload');


function autoload($clase, $dir = null)
{

    // 🡇 Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)) {
        $dirname = str_replace('/public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }

    // 🡇 Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {

        // 🡇 Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir . "/" . $file) AND substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        }
        // 🡇 Si es archivo y el nombre coincide con la clase (quitando el namespace)
        else if (is_file($dir . "/" . $file) AND $file == substr(strrchr($clase, "\\"), 1) . ".php") {
            require($dir . "/" . $file);
        }
    }
}

// 🡇 Compruebo que ruta me estan pidiendo
$home = '/cms/public/index.php/';

// 🡇 La guardo a la sesion
$_SESSION['home'] = $home;

// 🡇 Declaro la variable sin la primera parte de la url que no necesito
$ruta = str_replace($home, '', $_SERVER["REQUEST_URI"]);


// 🡇 Array de la ruta.
$array_ruta = explode('/', $ruta);

// 🡇 Si array ruta = 2 y estan seteados los dos valores y el primer valor del array es 'noticias'
if (count($array_ruta) == 2 && isset($array_ruta[1]) && $array_ruta[0] == 'noticias' && isset($array_ruta[1])) {

    switch ($array_ruta[0]) { // 🠴 si el primer valor es noticias
        case 'noticias':
            $slug = $array_ruta[1];  // 🠴 $slug recupera el valor del array[1] como parametro para la funcion
            $controller = new AppController; // 🠴 Instancio el controlador
            $controller->noticiaCompleta($slug); // 🠴 Utilizo la funcion noticiaCompleta del controlador
            break;
    }
} else if (count($array_ruta) == 4) { // 🠴 si el array tiene una longitud de 4
    switch ($array_ruta[0] . $array_ruta[1]) { // 🠴 Y los primeros datos son panel y usuarios
        case "panelusuarios":
            switch ($array_ruta[2]) { // 🠴 si el valor[2] del array corresponde con cualquiera de estos
                case "editar":
                case "borrar":
                case "activar":
                case "desactivar":
                    $controller = new UsuarioController; // 🠴 Instancio el controlador
                    $accion = $array_ruta[2];   // 🠴 recupero la accion del controlador del valor 2 del array
                    $id = $array_ruta[3]; // 🠴 recupero la id del valor 3 del array

                    $controller->$accion($id); // 🠴 Llamo a la accion
                    break;
                default:   // 🠴 si no corresponde se envia automaticamente al index del usuario
                    echo "default";
                    $controller = new UsuarioController; // 🠴 Instancio el controlador
                    $controller->index();
            }
            break;
        case "panelnoticias":
            switch ($array_ruta[2]) { // 🠴 si el valor[2] del array corresponde con cualquiera de estos
                case "editar":
                case "editarN":
                case "borrar":
                case "activar":
                case "desactivar":
                case "homeactivar":
                case "homedesactivar":
                case "upload":
                    $controller = new NoticiaController;// 🠴 Instancio el controlador
                    $accion = $array_ruta[2];
                    $id = $array_ruta[3];
                    $controller->$accion($id);// 🠴 Llamo a la accion
                    break;
                default:
                    echo "default noticias";
                    $controller = new NoticiaController; // 🠴 Instancio el controlador
                    $controller->index();
            }
            break;
        default:
            //Instancio el controlador
            $controller = new AppController; // 🠴 Instancio el controlador
            //Le mando el panel de acceso
            $controller->index();
    }
} else {
    // 🡇 Enrutaminentos
    switch ($ruta) {

        case 'panel':
            $controller = new UsuarioController;// 🠴 Instancio el controlador
            $controller->acceso(); // 🠴 Utilizo la funcion del controlador
            break;

        case 'panel/salir':
            $controller = new UsuarioController;// 🠴 Instancio el controlador
            $controller->salir(); // 🠴 Utilizo la funcion del controlador
            break;

        case 'panel/usuarios':
            $controller = new UsuarioController;// 🠴 Instancio el controlador
            $controller->index(); // 🠴 Utilizo la funcion del controlador
            break;

        case 'panel/usuarios/crear':
            $controller = new UsuarioController;// 🠴 Instancio el controlador
            $controller->crear(); // 🠴 Utilizo la funcion del controlador
            break;

        case 'panel/noticias':
            $controller = new NoticiaController;// 🠴 Instancio el controlador
            $controller->index(); // 🠴 Utilizo la funcion del controlador
            break;
        case 'panel/noticias/crear':
            $controller = new NoticiaController;// 🠴 Instancio el controlador
            $controller->crear(); // 🠴 Utilizo la funcion del controlador
            break;
        case 'noticias':
            $controller = new AppController; // 🠴 Instancio el controlador
            $controller->noticias(); // 🠴 Utilizo la funcion del controlador
            break;
        case 'contacto':
            $controller = new AppController; // 🠴 Instancio el controlador
            $controller->contacto(); // 🠴 Utilizo la funcion del controlador
            break;

        default :
            $controller = new AppController; // 🠴 Instancio el controlador
            $controller->index(); // 🠴 Utilizo la funcion del controlador
    }
}
