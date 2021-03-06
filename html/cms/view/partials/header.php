<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php $home = '/cms/public/index.php/' ?>
    <?php $rutaTitulo = str_replace($home, '', $_SERVER["REQUEST_URI"]) ?>
    <?php $title = ($rutaTitulo == "" || $rutaTitulo == "/cms/public/" || $rutaTitulo == "/cms/public/index.php") ? 'Página principal' : $rutaTitulo ?>
    <title>No Huddle |  <?php echo ucfirst($title) ?></title>
    <link rel="shortcut icon" href="<?php echo $public . "img/favicon.jpg" ?>" type="image/x-icon"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="<?php echo $public . "js/javascript.js" ?>"></script>
    <link href="<?php echo $public . "css/style.css" ?>" rel="stylesheet" type="text/css">
</head>
<body id="body">