<?php
    session_start();
    if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
        header("location: index.php", true);
    }
    $vacac = "";
    if (true) {
        $al_us= "
            <div id='al_us' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Alta de Usuarios
                </div>
            </div>
            ";
    }
    
    $in_va = "";
    if ($_SESSION["insertar_vac"]) {
        $ba_us= "
            <div id='ba_us' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Baja de Usuarios
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
        <!--<link href="css/00_marcos.css" rel="stylesheet" type="text/css"/>-->
        
        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesSubMenu.js" type="text/javascript"></script>
        <script src="js/cabecera.js" type="text/javascript"></script>
        <script src="js/logo_colegio.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div id="minicabecera">
                <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
                <div id="logo">Proyecto</div>
            </div>
            <div class="submenu menu-general alter">
                <?=$al_us?>
                <?=$ba_us?>
            </div>
            <div id="minipie">
                <img id="logocolegio" src="img/virgen_de_la_paz_logo.png" alt=""/>
            </div>
        </div>
    </body>
</html>
