<?php
    session_start();
    if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
        header("location: index.php", true);
    }
    /*
    $_SESSION["insertar_vac"]
    $_SESSION["gestionar_vac"]
    $_SESSION["anular_vac"]
    $_SESSION["reportes"]
     */
    $gest="";
    if ($_SESSION["categoria"]!="AGENTE") {
        $gest ="<div id='gestion' class='menu-elemento menu-elemento-general menu-elemento-animacion'>
                    <div class='menu-elemento-contenido'>
                        Gestion de Usuarios
                    </div>
                </div>";
    }
        $vaca ="<div id='vacaciones' class='menu-elemento menu-elemento-general menu-elemento-animacion'>
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
        
        <script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="js/funcionesMenu.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="caja">
            <div class="menu menu-general">
                <?=$gest?>
                <?=$vaca?>
            </div>
        </div>
    </body>
</html>
