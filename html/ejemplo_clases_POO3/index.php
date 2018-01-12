<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 2: Constructores de clase </h2>";

//Como crear o definir una clase
class Contacto{

    // Variables o atributos
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;

    //Metodo constructor antiguo
    /*
    function Contacto($miNombre,$misApellidos,$miEdad,$miEmail){
        $this->nombre = $miNombre;
        $this->apellidos = $misApellidos;
        $this->edad = $miEdad;
        $this->email = $miEmail;
    }*/

    //Metodo constructor nuevo
    function __construct($miNombre,$misApellidos,$miEdad,$miEmail){
        $this->nombre = $miNombre;
        $this->apellidos = $misApellidos;
        $this->edad = $miEdad;
        $this->email = $miEmail;
    }
}


//Instanciar la clase valido para metodo antiguo y nuevo
$mi_contacto = new Contacto("Sergio","Collazos Sales",29,"slaize@gmail.com");

echo "El contacto se llama: " . $mi_contacto->nombre . " " . $mi_contacto->apellidos;