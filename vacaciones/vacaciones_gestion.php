<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';

if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: /proyecto/index.php", true);
}

$link = conexion();
$arr_usuarios = lanzar_query(select_usuarios(), $link, MYSQLI_ASSOC);
$opc_usuarios = "";
for ($i = 0; $i < count($arr_usuarios); $i++) {
    $opc_usuarios .= opciones($arr_usuarios[$i]["login"], $arr_usuarios[$i]["login"], $arr_usuarios[$i]["nombre"], $arr_usuarios[$i]["apellidos"]);
}
$arr_depart = lanzar_query(select_departamentos(), $link, MYSQLI_ASSOC);
$opc_depart = "";
for ($i = 0; $i < count($arr_depart); $i++) {
    $opc_depart .= opciones($arr_depart[$i]["departamento"], $arr_depart[$i]["departamento"]);
}
$arr_turnos = lanzar_query(select_turnos(), $link, MYSQLI_ASSOC);
$opc_turnos = "";
for ($i = 0; $i < count($arr_turnos); $i++) {
    $opc_turnos .= opciones($arr_turnos[$i]["turno"], $arr_turnos[$i]["turno"]);
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
        <link href="../css/formulario_general.css" rel="stylesheet" type="text/css"/>
        <link href="../css/tabla.css" rel="stylesheet" type="text/css"/>
        <link href="../css/logo.css" rel="stylesheet" type="text/css"/>

        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/popper.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../js/moment.min.js" type="text/javascript"></script>
        <script src="../js/cabecera.js" type="text/javascript"></script>
        <script src="../js/funciones_generales.js" type="text/javascript"></script>
        <script src="../js/funciones_fechas.js" type="text/javascript"></script>
        <script src="js/vacaciones_gestion.js" type="text/javascript"></script>
        
<!--        <link href="../css/00_marcos.css" rel="stylesheet" type="text/css"/>-->
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
                Busqueda.
            </div>
            <div class="controles">
                <div class='c_elemento'>
                    <label for='usuarios'>Usuario.</label>
                    <select id='usuarios' class='selectpicker' data-style='btn-outline' data-live-search='true'>
                        <option value='@' selected=''>Todo.</option>
                        <?= $opc_usuarios ?>
                    </select>
                    <label for='departamento'>Departamento.</label>
                    <select id='departamento' class='selectpicker' data-style='btn-outline' data-live-search='true'>
                        <option value='@' selected=''>Todo.</option>
                        <?= $opc_depart ?>
                    </select>
                </div>
                <div class="c_elemento">
                    <label for="turno">Turno.</label>
                    <select id="turno" class="selectpicker" data-style="btn-outline" data-width="8.2em">
                        <option value="@">Todo.</option>
                        <?= $opc_turnos ?>
                    </select>
                    <label for="gestion">Gestion.</label>
                    <select id="gestion" class="selectpicker" data-style="btn-outline" data-width="8.2em">
                        <option value="@" data-content='<span class="badge badge-light">TODO</span>'>TODO</option>
                        <option value="PENDIENTE" data-content='<span class="badge badge-secondary">PENDIENTE</span>'>PENDIENTE</option>
                        <option value="CONFIRMADO" data-content='<span class="badge badge-success">CONFIRMADO</span>'>CONFIRMADO</option>
                        <option value="RECHAZADO" data-content='<span class="badge badge-danger">RECHAZADO</span>'>RECHAZADO</option>
                    </select>
                </div>
                <div class="c_elemento">
                    <label for="tipo">Solicitud.</label>
                    <select id="tipo" class="selectpicker" data-style="btn-outline" data-width="7em">
                        <option value="@" selected="">Todo.</option>
                        <option value="D">Días.</option>
                        <option value="S">Semanas.</option>
                    </select>
                </div>
                <div class="c_elemento">
                    <label>Fecha de Vacaciones.</label>
                    <label for="f_ini">Inicio.</label>
                    <input id="f_ini" class="form-control btn-outline" type="date"/>
                    <label for="f_fin">Fin.</label>
                    <input id="f_fin" class="form-control btn-outline" type="date"/>
                </div>
                <div class="c_elemento">
                    <label>Fecha de Solicitud.</label>
                    <label for="f_ini_s">Inicio.</label>
                    <input id="f_ini_s" class="form-control btn-outline" type="date"/>
                    <label for="f_fin_s">Fin.</label>
                    <input id="f_fin_s" class="form-control btn-outline" type="date"/>
                </div>
                <div class="c_elemento">
                    <label>Fecha de Gestión.</label>
                    <label for="f_ini_g">Inicio.</label>
                    <input id="f_ini_g" class="form-control btn-outline" type="date"/>
                    <label for="f_fin_g">Fin.</label>
                    <input id="f_fin_g" class="form-control btn-outline" type="date"/>
                </div>
                
                <div class="c_elemento">
                    <button id="buscar" class="btn btn-outline-primary mybutt">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        <div class='bloque bloque-tabla-gestion'>
            <table class="tabla tabla-gestion">
                <thead>
                    <tr>
                        <td class="cel col_login">Login.</td>
                        <td class="cel col_nombre">Nombre.</td>
                        <td class="cel col_apellidos">Apellidos.</td>
                        <td class="cel col_fecha_antiguedad">Fecha de antiguedad.</td>
                        <td class="cel col_departamento">Departamento.</td>
                        <td class="cel col_categoria">Categoría.</td>
                        <td class="cel col_turno">Turno.</td>
                        <td class="cel col_fecha_ini">Fecha de Inicio.</td>
                        <td class="cel col_fecha_fin">Fecha de Fin.</td>
                        <td class="cel col_fecha_solicitud">Fecha de Solicitud.</td>
                        <td class="cel col_estado">Estado.</td>
                        <td class="cel col_degest"></td>
                        <td class="cel col_fecha_gestion">Fecha de Gestion.</td>
                        <td class="cel col_usuario_gestiona">Gestor.</td>
                    </tr>
                </thead>
                <tbody class="tcuerpo"></tbody>
            </table>
        </div>
    </body>
</html>