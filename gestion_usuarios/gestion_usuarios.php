<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';

if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: /proyecto/index.php", true);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>vacaciones</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fontawesome-free-5.8.2-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/cabecera.css" rel="stylesheet" type="text/css"/>
        <link href="../css/logo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/formulario_general.css" rel="stylesheet" type="text/css"/>
        <link href="css/gestion_usuarios.css" rel="stylesheet" type="text/css"/>

        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/popper.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../js/moment.min.js" type="text/javascript"></script>
        <script src="../js/cabecera.js" type="text/javascript"></script>
        <script src="../js/funciones_generales.js" type="text/javascript"></script>
        <script src="js/gestion_usuarios.js" type="text/javascript"></script>

        <!--<link href="../css/00_marcos.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <div id="cabecera">
            <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
            <div id="usuario"><?= $_SESSION["user"] ?></div>
            <div id="titulo">Gestionar Vacaciones.</div>
            <div id="logo">Proyecto</div>
        </div>
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        <div class="bloque">
            <div class="titulo">
                Inserción de usuarios.
            </div>
            <div class="c_elemento">
                <label for="pegado_especial">Pega aquí los usuarios desde una hoja de calculo de Microsoft Excel<sup>&copy;</sup>.</label>
                <textarea id="pegado_especial" class="form-control"></textarea>
            </div>
        </div>
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        <div class="bloque" id="form_gest_usu">
            <div class="controles">
                <div class="c_elemento">
                    <label for="login">Login.</label>
                    <input type="text" id="login" class="form-control login"/>
                </div>
                <div class="c_elemento">
                    <label for="nombre">Nombre.</label>
                    <input type="text" id="nombre" class="form-control nombre"/>
                </div>
                <div class="c_elemento">
                    <label for="apellidos">Apellidos.</label>
                    <input type="text" id="apellidos" class="form-control apellidos"/>
                </div>
                <div class="c_elemento">
                    <label for="categoria">Categoría.</label>
                    <input id="categoria" class="form-control categoria"/>
                </div>
                <div class="c_elemento">
                    <label for="departamento">Departamento.</label>
                    <input type="text" id="departamento" class="form-control departamento"/>
                </div>
                <div class="c_elemento">
                    <label for="fecha_ant">Fecha de Antigüedad.</label>
                    <input type="date" id="fecha_ant" class="form-control fecha_ant"/>
                </div>
                <div class="c_elemento">
                    <label for="turno">Turno.</label>
                    <input type="text" id="turno" class="form-control turno"/>
                </div>
                <div class="c_elemento">
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="ins_vac" class="custom-control-input ins_vac"/>
                        <label for="ins_vac" class="custom-control-label">Insertar Vacaciones.</label>
                    </div>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="ges_vac" class="custom-control-input ges_vac"/>
                        <label for="ges_vac" class="custom-control-label">Gestionar Vacaciones.</label>
                    </div>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="anu_vac" class="custom-control-input anu_vac"/>
                        <label for="anu_vac" class="custom-control-label">Anular Vacaciones.</label>
                    </div>
                </div>
                <div class="c_elemento custom-checkbox custom-control">
                    <input type="checkbox" id="reportes" class="custom-control-input reportes"/>
                    <label for="reportes" class="custom-control-label">Reportes.</label>
                </div>
            </div>
        </div>
    </body>
</html>