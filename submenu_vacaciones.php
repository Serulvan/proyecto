<?php
    session_start();
    if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
        header("location: index.php", true);
    }
    $vacac = "";
    if (true) {
        $vacac= "
            <div id='vacac' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Vacaciones
                </div>
            </div>
            ";
    }
    
    $in_va = "";
    if ($_SESSION["insertar_vac"]) {
        $in_va= "
            <div id='in_va' class='submenu-elemento menu-elemento-general menu-elemento-animacion'>
                <div class='submenu-elemento-contenido'>
                    Insertar Vacaciones
                </div>
            </div>
            ";
    }
    
    $ge_va = "";
    if ($_SESSION["gestionar_vac"]) {
        $ge_va= "
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
        
        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesSubMenu.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div class="submenu menu-general">
                <?=$vacac?>
                <?=$in_va?>
                <?=$ge_va?>
            </div>
        </div>
    </body>
</html>
