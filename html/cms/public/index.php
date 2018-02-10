<?php

namespace App;
session_start();

use App\Controller\UsuarioController;
use App\Controller\NoticiaController;

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

//La guardo a la sesion
$_SESSION['home'] = $home;


$ruta = str_replace($home, '', $_SERVER["REQUEST_URI"]);
$array_ruta = explode("/", $ruta);

/*
//Array de la ruta
$array_ruta = explode("/", $ruta);

switch (count($array_ruta)) {

    case 1:
        ruta1($array_ruta);
        break;
    case 2:
        ruta2($array_ruta);
        break;
    case 3:
        echo "estoy en panel/noticas/crear, en panel/usuarios/crear,";
        break;
    case 4:
        echo "estoy eneditado, activando y borrando";
        break;
    default:
        echo "Página incorrecta redirijo a la home";
}

foreach ($array_ruta as $a) {

}

//Saco el controlador
function ruta1($array_ruta)
{
    switch ($array_ruta[0]) {
        case "":
            return "";
        case "panel":
            return "UsuarioController";
        case "noticias":
            return "NoticiaController";
        default:
            return "Error";
    }
}

// Saco la accion
function ruta2($array_ruta)
{
    // Recupero el controlador
    $controlador = ruta1($array_ruta);

    switch ($controlador) {
        case "UsuarioController":
            return $array_ruta[1];
        case "NoticiaController":
            return $array_ruta[1];
    }

    switch ($array_ruta[1]) {
        case "":
            return "";
        case "panel":
            return "UsuarioController";
        case "noticias":
            return "NoticiaController";
        default:
            return "Error";
    }
}

*/  // Parte de enrutamiento con switchs

// Array de la ruta.
$array_ruta = explode('/', $ruta);

if (count($array_ruta) == 4) {
    switch ($array_ruta[0] . $array_ruta[1]) {
        case "panelusuarios":
            switch ($array_ruta[2]) {
                case "editar":
                case "borrar":
                case "activar":
                case "desactivar":
                    $controller = new UsuarioController;
                    $accion = $array_ruta[2];
                    $id = $array_ruta[3];
                    //Llamo a la accion
                    $controller->$accion($id);
                    break;
                default:
                    echo "default";
                    $controller = new UsuarioController;
                    $controller->index();
            }
            break;
        case "panelnoticias":
            switch ($array_ruta[2]) {
                case "editar":
                case "editarN":
                case "borrar":
                case "activar":
                case "desactivar":
                case "homeactivar":
                case "homedesactivar":
                    $controller = new NoticiaController;
                    $accion = $array_ruta[2];
                    $id = $array_ruta[3];
                    //Llamo a la accion
                    $controller->$accion($id);
                    break;
                default:
                    echo "default noticias";
                    $controller = new NoticiaController;
                    $controller->index();
            }
            break;
        default:
            //Instancio el controlador
            $controller = new AppController;
            //Le mando el panel de acceso
            $controller->acceso();
    }
    /*  if ($array_ruta[0] . $array_ruta[1] == "panelusuarios") {
          if ($array_ruta[2] == "editar" OR
              $array_ruta[2] == "borrar" OR
              $array_ruta[2] == "activar" OR
              $array_ruta[2] == "desactivar") {
              $controller = new UsuarioController;
              $accion = $array_ruta[2];
              $id = $array_ruta[3];
              //Llamo a la accion
              $controller->$accion($id);
          } else {
              $controller = new UsuarioController;
              $controller->index();
          }


      } elseif ($array_ruta[0] . $array_ruta[1] == "panelnoticias") {
          if ($array_ruta[2] == "editar" OR
              $array_ruta[2] == "borrar" OR
              $array_ruta[2] == "activar" OR
              $array_ruta[2] == "desactivar") {
              $controller = new NoticiaController;
              $accion = $array_ruta[2];
              $id = $array_ruta[3];
              //Llamo a la accion
              $controller->$accion($id);
          } else {
              $controller = new NoticiaController;
              $controller->index();
          }

      } else {
          //Instancio el controlador
          $controller = new AppController;
          //Le mando el panel de acceso
          $controller->acceso();
      }*/
} else {
    //Enrutaminetos
    switch ($ruta) {

        //Panel
        case 'panel':
            //Instancio el controlador
            $controller = new UsuarioController;
            //Le mando el panel de acceso
            $controller->acceso();
            break;

        case 'panel/salir':
            //Instancio el controlador
            $controller = new UsuarioController;
            //Le mando al método salir
            $controller->salir();
            break;

        case 'panel/usuarios':
            //Instancio el controlador
            $controller = new UsuarioController;
            //Le mando al método salir
            $controller->index();
            break;

        case 'panel/usuarios/crear':
            //Instancio el controlador
            $controller = new UsuarioController;
            //Le mando al método salir
            $controller->crear();
            break;

        case 'panel/noticias':
            //Instancio el controlador
            $controller = new NoticiaController;
            //Le mando al método salir
            $controller->index();
            break;
        case 'panel/noticias/crear':
            //Instancio el controlador
            $controller = new NoticiaController;
            //Le mando al método salir
            $controller->crear();
            break;
        default : //Instancio el controlador
            $controller = new AppController;
            //Le mando al método salir
            $controller->index();
    }
}


//Llamo al pie
require("../view/partials/footer.php");