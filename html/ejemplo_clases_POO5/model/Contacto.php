<?php
class Contacto{
    // Variables o atributos
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;

    //Metodo constructor nuevo
    function __construct($miNombre,$misApellidos,$miEdad,$miEmail){
        $this->nombre = $miNombre;
        $this->apellidos = $misApellidos;
        $this->edad = $miEdad;
        $this->email = $miEmail;
    }

    // Establecemos el email
    public function setEmail($miEmail){
        $this->email = $miEmail;
    }

    // Recuperamos el email
    public function getEmail (){
        return $this->email;
    }

}