<?php

namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; //Conexion a la base de datos


class AppController
{
    //Funcion para la conexion con la BBDD, habra que copiar en los contructores
    var $db;
    var $view;
    var $datos;

    function __construct()
    {
        //Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    } // Completa


    function index()
    {
        $resultado = $this->db->query('SELECT * FROM noticias WHERE activa=1 AND home=1 LIMIT 5');

        $noticias = [];
        while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($datos);
        }
        // Le paso los datos
        $this->view->vista("home", $noticias);
    }

    function noticias()
    {
        $resultado = $this->db->query('SELECT * FROM noticias WHERE activa=1');

        $noticias = [];
        while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($datos);
        }
        // Le paso los datos
        $this->view->vista("listadoNoticias", $noticias);
    }

    function noticiaCompleta($slug)
    {
        if ($slug) {
            $resultado = $this->db->query("SELECT * FROM noticias WHERE slug='" .$slug . "' LIMIT 1");

            $noticias = [];
            while ($datos = $resultado->fetch(\PDO::FETCH_OBJ)) {
                $noticias [] = new Noticia($datos);
            }
            // Le paso los datos
            $this->view->vista("noticiaCompleta", $noticias);
        }
    }

    function contacto()
    {
            // Le paso los datos
            $this->view->vista("contacto", "");

    }
}