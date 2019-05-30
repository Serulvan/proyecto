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
        <!--<link href="css/00_marcos.css" rel="stylesheet" type="text/css"/>-->
        
        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesSubMenu.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div id="logo">Proyecto</div>
            <div class="submenu menu-general alter">
                <?=$al_us?>
                <?=$ba_us?>
            </div>
            
        </div>
    </body>
</html>
