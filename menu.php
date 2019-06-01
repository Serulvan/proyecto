<?php
session_start();
if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: index.php", true);
}

$gest = "";
if ($_SESSION["gestionar_vac"] == 1) {
    $gest = "<div id='gestion' class='menu-elemento menu-elemento-general menu-elemento-animacion'>
                    <div class='menu-elemento-contenido'>
                        Gestion de Usuarios
                    </div>
                </div>";
}
$vaca = "<div id='vacaciones' class='menu-elemento menu-elemento-general menu-elemento-animacion'>
                        <div class='menu-elemento-contenido'>
                            Vacaciones
                        </div>
                    </div>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>menu</title>

        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/logo.css" rel="stylesheet" type="text/css"/>
        <link href="css/fontawesome-free-5.8.2-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/cabecera.css" rel="stylesheet" type="text/css"/>

        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesMenu.js" type="text/javascript"></script>
        <script src="js/cabecera.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div id="minicabecera">
                <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
                <div id="logo">Proyecto</div>
            </div>
            <div class="menu menu-general">
                <?= $gest ?>
                <?= $vaca ?>
            </div>
        </div>
    </body>
</html>
