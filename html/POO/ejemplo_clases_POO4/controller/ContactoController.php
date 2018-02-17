<?php

class ContactoController
{

    function index()
    {
        $contacto = new Contacto("Sergio", "Collazos", 29, "");

        $contacto->setEmail("slaize@gmail.com");

        require("view/usuarios.php");
    }


}