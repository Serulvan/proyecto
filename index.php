<?php
session_start();
session_destroy();
session_start();
$_SESSION["url_base"] = filter_input(INPUT_SERVER, 'SERVER_NAME') . filter_input(INPUT_SERVER, 'REQUEST_URI');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>

        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesIndex.js" type="text/javascript"></script>
    </head>
    <body>
        <form id="login_form" class="caja">
            <div class="logo mb-2">
                <img src="img/logo.png" alt=""/>
            </div>
            <div class="mb-2">
                <input class="form-control" id="user" type="text" value="M10" placeholder="Usuario"/>
            </div>
            <div class="mb-2">
                <input class="form-control" id="pass" type="password" value="1234" placeholder="Contraseña"/>
            </div>
            <div class=" ">
                <input id="entrar" class="btn btn-outline-dark" type="submit" value="ENTRAR"/>
            </div>
        </form>
    </body>
</html>
