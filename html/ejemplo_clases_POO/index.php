<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 1: definir e instanciar clases </h2>";

//Como crear o definir una clase
class Contacto{

    // Variables o atributos
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;

    //Funciones o metodos

        // funcion para establecer el nombre
        function setNombre($miNombre){
            $this->nombre = $miNombre;
        }

        // funcion para recuperar el nombre
        function getNombre(){
            return $this->nombre;
        }
}

//Instanciar o utilizar la clase

//Primero inicializar un objeto de tipo de la clase en este caso contacto.

$mi_contacto = new Contacto;

//Accedo a las funciones o metodos mediante: $nombre_del_objeto->nombre_del_metodo
$mi_contacto->setNombre("Sergio");

// Uso la funcion get
echo "El contacto se llama: " . $mi_contacto->getNombre() . "<br>";

// Uso la variable mediante: $nombre_del_objeto->nombre_del_atributo
echo "El contacto se llama: " . $mi_contacto->nombre;