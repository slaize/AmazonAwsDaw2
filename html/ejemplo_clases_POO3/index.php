<?php

echo "<h1>Introduccion a la programacion orientada a objetos </h1>";
echo "<h2>Ejemplo 3: Instanciar una clase externa</h2>";


//Referenciamos el fichero de la clase con "require", o "include"
// Si lo usamos acompañado de _once solo lo carga una vez y no modifique los datos.
require_once("Contacto.php");

//Instanciar la clase
$mi_contacto = new Contacto("Sergio","Collazos Sales",29,"slaize@gmail.com");

echo "El contacto se llama: " . $mi_contacto->nombre . " " . $mi_contacto->apellidos;