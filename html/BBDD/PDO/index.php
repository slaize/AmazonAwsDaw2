<?php

// Invocamos a la conexion con la BBDD
require ("conexion.php");

//Insert
$registros = $db->exec('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
if ($registros){
    echo "Se han insertado $registros registros."."<br>";
}

//Delete
$registros = $db->exec('DELETE FROM personas WHERE id>3');
if ($registros){
    echo "Se han borrado $registros registros."."<br>";
}

//Update
$registros = $db->exec('UPDATE personas SET activo=1 WHERE activo=0');
if ($registros){
    echo "Se han activado $registros registros."."<br>";
}
echo "<hr>";


//Select con BOTH, devuelve tanto claves asociativas como claves numericas
echo " Select con BOTH devuelve tanto claves asociativas como claves numericas <br>";
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch()){ //O bien ($resultado->fetch(PDO::FETCH_BOTH)
    echo $personas['id']." ".$personas[1]." ".$personas['activo']."<br>";
}
echo "<hr>";


//Select con ASSOC
echo " Select con ASSOC devuelve claves asociativas <br>";
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_ASSOC)){ //Recorro el resultado
    echo $personas['id']." ".$personas['nombre']." ".$personas['activo']."<br>";
}
echo "<hr>";


//Select con NUM
echo " Select con NUM devuelve claves numericas <br>";
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_NUM)){ //Recorro el resultado
    echo $personas[0]." ".$personas[1]." ".$personas[2]."<br>";
}
echo "<hr>";


//Select con OBJ
echo " Select con OBJ, devuelve un objeto cuyas propiedades coinciden con las columnas de la tabla / campos del registro<br>";
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_OBJ)){ //Recorro el resultado
    echo $personas->id." ".$personas->nombre." ".$personas->activo."<br>";
}
echo "<hr>";

//Select con LAZY
echo " Select con LAZY devuelve el objeto y el array con clave dual de FETCH_BOTH <br>";
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_LAZY)){ //Recorro el resultado
    echo $personas[0]." ".$personas['nombre']." ".$personas->activo."<br>";
}
echo "<hr>";


//Select con BOUND
echo "Select con BOUND, devuelve true y asigna los valores del registro a variables según se indique en el método bindColumn<br>";
$resultado = $db->query('SELECT * FROM personas');
$resultado->bindColumn(1, $id);
$resultado->bindColumn(2, $nombre);
$resultado->bindColumn(3, $activo);
while ($personas = $resultado->fetch(PDO::FETCH_BOUND)){ //Recorro el resultado
    echo $id." ".$nombre." ".$activo."<br>";
}
echo "<hr><hr>";
echo "<h3> Transacciones</h3>";
//Iniciamos la trasnacción para que no ejecute cada una de ellas por separado
$db->beginTransaction();
//Declaramos todas las consultas
$resultado = $db->exec('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
$resultado = $db->exec('DELETE FROM personas WHERE id>3');
$resultado = $db->exec('UPDATE personas SET activo=0 WHERE activo=1');
//Realizamos el commit para que se ejecuten todas las consultas
$db->commit();
//Mensaje
if ($resultado){
    echo "Se han activado $resultado registros.";
}
echo "<br>";
echo "<hr><hr>";
echo "<h3> Consultas preparadas</h3>";

//Consulta preparada
$nombres = ['Jorgito', 'Juanito', 'Jaimito'];
$resultado= $db->prepare("INSERT INTO personas (nombre) VALUES (?)");
//O bien $resultado= $db->->prepare('INSERT INTO personas (nombre) VALUES (:nombre)');
foreach ($nombres as $nombre){
    $resultado->bindParam(1, $nombre); //O bien $resultado->bind_param(':nombre', $nombre);
    $resultado->execute();
}