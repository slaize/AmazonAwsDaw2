<h3>El id es: <?php echo $datos->id?> </h3>
<h3>El usuario es: <?php echo $datos->usuario?> </h3>
<h3>La clave (encriptada) es: <?php echo $datos->clave?> </h3>
<h4>Fecha de acceso: <?php echo $datos->fecha_acceso ?></h4>
<h4>Activo: <?php echo $datos->activo ?></h4>
<h4>Usuarios: <?php echo $datos->usuarios ?></h4>

<?php
/*
// Comprobador de contraseñas encriptadas con crypt
if (hash_equals($datos->clave, crypt('1', $datos->clave))) {
    echo "¡Contraseña verificada!";
}*/
?>
