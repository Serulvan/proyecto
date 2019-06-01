<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';

if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: /proyecto/index.php", true);
}

$link = conexion();
$arr = lanzar_query(select_usuarios(),$link);
$opciones = "";
for ($i = 0; $i < count($arr); $i++) {
    $opciones .= opciones($arr[$i][0], $arr[$i][0], $arr[$i][1], $arr[$i][2]);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basa Usuario</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fontawesome-free-5.8.2-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/cabecera.css" rel="stylesheet" type="text/css"/>
        <link href="../css/logo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/formulario_general.css" rel="stylesheet" type="text/css"/>
        <link href="css/baja_usuarios.css" rel="stylesheet" type="text/css"/>

        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/popper.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../js/cabecera.js" type="text/javascript"></script>
        <script src="js/baja_usuarios.js" type="text/javascript"></script>


<!--        <link href="../css/00_marcos.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <div id="cabecera">
            <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
            <div id="usuario"><?= $_SESSION["user"] ?></div>
            <div id="titulo">Baja de Usuarios.</div>
            <div id="logo">Proyecto</div>
        </div>
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        <div class="bloque">
            <div class="controles">
                <div class="c_elemento">
                    <label for="usuarios">Selecciona un Usuario.</label>
                    <select id="usuarios" class="selectpicker" data-live-search="true" title="Selecciona un Usuario." data-style="btn-outline">
                        <?=$opciones?>
                    </select>
                </div>
                <div class="c_elemento">
                    <button id="baja" class="btn btn-outline-danger mybutt" disabled="true">Baja</button>
                </div>
            </div>
        </div>
    </body>
</html>