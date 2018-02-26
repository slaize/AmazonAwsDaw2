<?php

namespace App\Controller; // 🠴 App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; // 🠴 Conexion a la base de datos


class AppController
{
    // 🡇 Funcion para la conexion con la BBDD, habra que copiar en los contructores
    var $db;
    var $view;
    var $datos;

    function __construct()
    {
        // 🡇 Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;

        // 🡇 Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    function index() // 🠴 Funcion para el index de la pagina
    {
        // 🡇 Realizo una query para recuperar las noticias del index, solo mostrara las que tengan la casilla home activa en el panel
        // 🡇 Limitara el resultado a 5 que seran las 5 mas nuevas respecto a fecha de publicacion
        $resultado = $this->db->query('SELECT * FROM noticias WHERE activa=1 AND home=1 order by fecha_publicacion DESC  LIMIT 5');


        $noticias = [];// 🠴 Iniciamos el array que tendra dentro las noticias

        // 🡇 Asigno la consulta a variable
        while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($datos);
        }

        $this->view->vista("home", $noticias); // 🠴 Le paso los datos a la vista
    }

    function noticias() // 🠴 Funcion para la vista del listado de noticias
    {
        // 🡇 Realizo una query para recuperar las noticias activas, solo mostrara las que esten activadas en el panel
        $resultado = $this->db->query('SELECT * FROM noticias WHERE activa=1 order by fecha_publicacion DESC ');

        $noticias = [];// 🠴 Iniciamos el array que tendra dentro las noticias

        // 🡇 Asigno la consulta a variable
        while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($datos);
        }

        $this->view->vista("listadoNoticias", $noticias); // 🠴 Le paso los datos a la vista
    }

    function noticiaCompleta($slug) // 🠴 Funcion para la vista de noticia completa
    {
        // 🡇 Si la noticia que nos llega contiene la variable $slug procedemos a ppasar los datos para pintarla
        if ($slug) {

            // 🡇 Realizo una query para recuperar las noticias activas, solo mostrara las que esten activadas en el panel
            $resultado = $this->db->query("SELECT * FROM noticias WHERE slug='" . $slug . "' LIMIT 1");

            // 🡇 Asigno la consulta a variable
            $noticias = [];
            while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
                $noticias [] = new Noticia($datos);
            }

            $this->view->vista("noticiaCompleta", $noticias); // 🠴 Le paso los datos a la vista
        }
    }

    function contacto() // 🠴 Funcion para la vista de contacto
    {
        $this->view->vista("contacto", "");// 🠴 Le paso los datos a la vista

    }
}

