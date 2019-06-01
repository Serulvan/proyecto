<?php
session_start();
if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: index.php", true);
}
$vacac = "";
if (true) {
    $vacac = "
            <div id='vacac' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Vacaciones
                </div>
            </div>
            ";
}

$in_va = "";
if ($_SESSION["insertar_vac"]) {
    $in_va = "
            <div id='in_va' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Insertar Vacaciones
                </div>
            </div>
            ";
}

$ge_va = "";
if ($_SESSION["gestionar_vac"]) {
    $ge_va = "
            <div id='ge_va' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Gestionar Vacaciones
                </div>
            </div>
            ";
}
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
        <script src="js/funcionesSubMenu.js" type="text/javascript"></script>
        <script src="js/cabecera.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div id="minicabecera">
                <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
                <div id="logo">Proyecto</div>
            </div>
            <div class="submenu menu-general">
                <?= $vacac ?>
                <?= $in_va ?>
                <?= $ge_va ?>
            </div>
        </div>
    </body>
</html>
