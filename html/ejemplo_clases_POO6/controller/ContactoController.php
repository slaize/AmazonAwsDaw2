<?php
namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Contacto;

class ContactoController
{
    function index()
    {
        $contacto = new Contacto("Sergio", "Collazos", 29, "");

        $contacto->setEmail("slaize@gmail.com");

        require("view/index.php");
    }


}