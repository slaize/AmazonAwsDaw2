<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 3: Instanciar una clase externa</h2>";

//Referenciamos el fichero de la clase con "require", o "include"
// Si lo usamos acompañado de _once solo lo carga una vez y no redeclare variables por error.
require_once("Contacto.php");

//Instanciar la clase
$mi_contacto = new Contacto("Sergio", "Collazos Sales", 29, "");

echo "El contacto se llama: " . $mi_contacto->nombre . " " . $mi_contacto->apellidos;

//Asigno valores a los datos de dos formas:
//Forma 1:
$mi_contacto->setEmail("slaize@gmail.com");

//Forma 2:
$mi_contacto->email = "slaize@gmail.com";

echo "El mail del contacto es: " . $mi_contacto->email;