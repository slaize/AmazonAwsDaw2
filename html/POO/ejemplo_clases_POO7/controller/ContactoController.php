<?php
namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;

class ContactoController
{
    function index()
    {
        $contacto = new Usuario("Sergio", "Collazos", 29, "");

        $contacto->setEmail("slaize@gmail.com");

        //Instancio el ViewHelper

        $view = new ViewHelper();

        $view->vista("index",$contacto);
    }


}