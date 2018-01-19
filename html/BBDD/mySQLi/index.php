<?php

require("conexion.php");

// Insert
$resultado = $db->query('INSERT INTO personas (nombre) VALUES ("Jose"),("Luis")');
echo "Resultado: $resultado";
echo "<br>";

//Delete

$resultado = $db->query('DELETE FROM personas WHERE id > 3');
echo "Resultado: $resultado";
echo "<br>";

//Update
$resultado = $db->query('UPDATE personas SET activo=1 WHERE activo=0');
if ($resultado) {
    echo "Se han activado $db->affected_rows registros";
    echo "<hr>";
}

//Select en un array con claves asociativas y numéricas (con MYSQLI_STORE_RESULT, da igual ponerlo que no)
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_BOTH); //O también $resultado->fetch_array()
while ($personas != null) { //Recorro el resultado
    echo $personas['id'] . " " . $personas[1] . " " . $personas['activo'] . "<br>";
    $personas = $resultado->fetch_array(MYSQLI_BOTH);
}
$resultado->free(); //Libero de la memoria
echo "<hr>";

//Select en un array con claves asociativas y numéricas (con MYSQLI_USE_RESULT)
$resultado = $db->query('SELECT * FROM personas', MYSQLI_USE_RESULT);
$personas = $resultado->fetch_array(MYSQLI_BOTH); //O también $resultado->fetch_array()
while ($personas != null) { //Recorro el resultado
    echo $personas['id'] . " " . $personas[1] . " " . $personas['activo'] . "<br>";
    $personas = $resultado->fetch_array(MYSQLI_BOTH);
}
$resultado->free(); //Libero de la memoria
echo "<hr>";

//Select en un array con claves asociativas
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_ASSOC); //O también $resultado->fetch_assoc()
while ($personas != null) { //Recorro el resultado
    echo $personas['id'] . " " . $personas['nombre'] . " " . $personas['activo'] . "<br>";
    $personas = $resultado->fetch_array(MYSQLI_ASSOC);
}
$resultado->free(); //Libero de la memoria
echo "<hr>";

//Select en un array con claves numéricas
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_NUM); //O también $resultado->fetch_row()
while ($personas != null) { //Recorro el resultado
    echo $personas[0] . " " . $personas[1] . " " . $personas[2] . "<br>";
    $personas = $resultado->fetch_array(MYSQLI_NUM);
}
$resultado->free(); //Libero de la memoria
echo "<hr>";

//Select en un objeto
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_object();
while ($personas != null) { //Recorro el resultado
    echo $personas->id . " " . $personas->nombre . " " . $personas->activo . "<br>";
    $personas = $resultado->fetch_object();
}
$resultado->free(); //Libero de la memoria
echo "<hr>";

//Select con un objeto, real_query y store_result
$booleano = $db->real_query('SELECT * FROM personas');
if ($booleano) {
    $resultado = $db->store_result(); //Almaceno el resultado de la última consulta
    $personas = $resultado->fetch_object();
    while ($personas != null) { //Recorro el resultado
        echo $personas->id . " " . $personas->nombre . " " . $personas->activo . "<br>";
        $personas = $resultado->fetch_object();
    }
    $resultado->free(); //Libero de la memoria
    echo "<hr>";
}

//Select con un objeto, real_query y use_result
$booleano = $db->real_query('SELECT * FROM personas');
if ($booleano) {
    $resultado = $db->use_result(); //Uso el resultado de la última consulta
    $personas = $resultado->fetch_object();
    while ($personas != null) { //Recorro el resultado
        echo $personas->id . " " . $personas->nombre . " " . $personas->activo . "<br>";
        $personas = $resultado->fetch_object();
    }
    $resultado->free(); //Libero de la memoria
    echo "<hr>";
}

//CONSULTAS CON AUTOCOMMIT DESHABILITADO

//Deshabilitamos el autocommit par que no se ejecute cada una de ellas por separado
$db->autocommit(false);
//Declaramos todas las consultas
$resultado = $db->query('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
$resultado = $db->query('DELETE FROM personas WHERE id>3');
$resultado = $db->query('UPDATE personas SET activo=1 WHERE activo=0');
//Realizamos el commit para que se ejecuten todas las consultas
$db->commit();
//Mensaje
if ($resultado){
    echo "Se han activado $db->affected_rows registros.";
}
echo "<hr>";

//CONSULTAS PREPARADAS

//Ejemplo 1 consulta (statement) preparada
$resultado = $db->stmt_init();
$resultado->prepare('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
$resultado->execute();
$resultado->close();

//Ejemplo 2 consulta preparada
$nombres = ['Jorgito', 'Juanito', 'Jaimito'];
$resultado = $db->stmt_init();
$resultado->prepare('INSERT INTO personas (nombre) VALUES (?)');
foreach ($nombres as $nombre){
    $resultado->bind_param('s', $nombre);
    $resultado->execute();

    /*  i - número entero (integer)
        d -número real con doble precisión (double)
        s - cadena de texto (string)
        b - cadena de texto en formato binario (blob)*/
}
$resultado->close();

//bind_result(), que asigna a variables los campos obtenidos en la consulta, como en el siguiente ejemplo:
//Consulta preparada con SELECT
$resultado = $db->stmt_init();
$resultado->prepare('SELECT * FROM personas');
$resultado->execute();
$resultado->bind_result($id, $nombre, $activo);
while ($resultado->fetch() != null){ //Recorre los registros devueltos
    echo $id." ".$nombre." ".$activo."<br>";
}
$resultado->close();
echo "<hr>";

//Cierro la conexión
$db->close();