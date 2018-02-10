<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">

</head>
<body>
<div id="cajaLogin">
    <img id="avatar" src="../img/avatar.png" alt="avatar">
    <p id="textoLogin">Bienvenido al panel de administración.</p>
    <form action="" method="post">
        <p class="usuarioContrasena"></p>
        <input type="text" name="usuario" id="usuario">
        <p class="usuarioContrasena">Contraseña</p>
        <input type="text" name="contrasena" id="contrasena">
        <input type="submit" name="login" value="Acceder" id="botonLogin">
    </form>
</div>

<div id="footer">
    <hr>
    <p>Pagina realizada por Sergio Collazos Sales Ⓒ 2018</p>
</div>

</body>
</html>