<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';
if (null !== filter_input(INPUT_POST, "tipo")) {
    $_SESSION["tipo"] = filter_input(INPUT_POST, "tipo");
}else{
    $tipo = $_SESSION["tipo"];
}

if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: /proyecto/index.php", true);
}

if ($tipo==1) {
    $link = conexion();
    $arr_list = lanzar_query(select_usuarios(), $link, MYSQLI_ASSOC);
    $opciones = "";
    for ($i = 0; $i < count($arr_list); $i++) {
        $opciones .= opciones($arr_list[$i]["login"], $arr_list[$i]["login"],$arr_list[$i]["nombre"],$arr_list[$i]["apellidos"]);
    }
    $select_usuarios="
        <div class='c_elemento'>
            <label for='usuarios'>Usuario.</label>
            <select id='usuarios' class='selectpicker' data-style='btn-outline' data-live-search='true'>
                <option value='' selected=''>[USUARIOS]</option>
                $opciones
            </select>
        </div>";
}else{
    $select_usuarios='';
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
        <link href="css/vacaciones.css" rel="stylesheet" type="text/css"/>
        
        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/popper.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../js/moment.min.js" type="text/javascript"></script>
        <script src="../js/cabecera.js" type="text/javascript"></script>
        <script src="../js/funciones_generales.js" type="text/javascript"></script>
        <script src="../js/funciones_fechas.js" type="text/javascript"></script>
        <script src="js/vacaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="cabecera">
            <div id="atras"><i class="fas fa-arrow-left fa-lg"></i></div>
            <div id="usuario"><?=$_SESSION["user"]?></div>
            <div id="titulo">Vacaciones.</div>
            <div id="logo">Proyecto</div>
        </div>
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        <div class="bloque">
            <div class="titulo">
                Solicitud.
            </div>
            <div class="controles">
                <?=$select_usuarios?>
                <div class="c_elemento">
                    <label for="seleccion">Vacaciones a Solicitar.</label>
                    <select id="seleccion" class="selectpicker" data-style="btn-outline" data-width="10em">
                        <option value="1">1 Día</option>
                        <option value="7" selected>1 Semana</option>
                        <option value="14">2 Semanas</option>
                        <option value="21">3 Semanas</option>
                        <option value="28">4 Semanas</option>
                    </select>
                </div>
                <div class="c_elemento">
                    <label for="f_ini">Fecha<span class="solo_dia"> de Inicio</span>.</label>
                    <input id="f_ini" class="form-control btn-outline" type="date"/>
                </div>
                <div class="c_elemento solo_dia f_fin_contenedor">
                    <label for="f_fin">Fecha de Fin.</label>
                    <input id="f_fin" class="form-control disabled-black" type="date" readonly=""/>
                </div>
                <div class="c_elemento">
                    <label for="dias">Nº de Días.</label>
                    <input id="dias" class="form-control disabled-black" type="text" readonly="" value="0"/>
                </div>
                <div class="c_elemento">
                    <button id="almacenar" class="btn btn-outline-success mybutt">Almacenar <i class="fas fa-save"></i></button>
                </div>
            </div>
        </div>
        
        <div class="separador_horizontal"></div><!------------------------------------------------------------------->
        
        <div class="bloque">
            <div class="titulo">
                Consulta.
            </div>
            <div class="controles">
                <div class="c_elemento">
                    <label for="year">Año.</label>
                    <select id="year" class="selectpicker" data-style="btn-outline" data-width="5em">
                        <option value="<?=date("Y")?>"><?=date("Y")?></option>
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
                    <button id="buscar" class="btn btn-outline-primary mybutt">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class='consulta'>
                <table class="tabla">
                    <thead>
                        <tr>
                            <td class="cel col_login">Login.</td>
                            <td class="cel col_fecha_solicitud">Fecha de Solicitud.</td>
                            <td class="cel col_fecha_ini">Fecha de Inicio.</td>
                            <td class="cel col_fecha_fin">Fecha de Fin.</td>
                            <td class="cel col_estado">Estado.</td>
                            <td class="cel col_fecha_gestion">Fecha de Gestion.</td>
                            <td class="cel col_usuario_gestiona">Gestor.</td>
                        </tr>
                    </thead>
                    <tbody class="tcuerpo"></tbody>
                </table>
            </div>
        </div>
    </body>
</html>