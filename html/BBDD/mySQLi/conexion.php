<?php
// Hay dos maneras de acceso
// Mediante el constructor de la clase
// La '@' omite los mensajes de error del sistema durante le ejecucion
@$db = new mysqli("localhost","root","toor","amazonaws");

    //Control de errores
    if($db ->connect_errno != null){
        echo "Error numero  $db->connect_errno <br>";
        echo "Mensaje: $db->connect_error";
    }

    //Configurar el charset
    $db->set_charset('utf8');

/*
// Forma obsoleta con objetos
$db = new sqli();
$db->connect("localhost","root","toor","amazonaws");

// Forma obsoleta sin objetos (procedimental)
$db = mysqli_connect("localhost","root","toor","amazonaws");
*/