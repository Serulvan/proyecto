<?php
function lanzar_query($sql, $link, $type = MYSQLI_BOTH) {
    $res = mysqli_query($link, $sql);
    if (!$res) {
        return mysqli_error($link);
    }else{
        return toArr($res, $type);
    }
}

function toArr($res, $type =  MYSQLI_BOTH){
    $dev = null;
    while ($row = mysqli_fetch_array($res,$type)) {
        $dev[]= $row;
    }
    return $dev;
}

function opciones($val, $a0){
    $arr_arg = func_get_args();
    $opcion =  "<option value='$val'>$a0";
    if (count($arr_arg)>2) {
        $opcion .= " - ";
    }
    for ($i = 2; $i < count($arr_arg); $i++) {
        $opcion.= " $arr_arg[$i]";
    }
    $opcion.="</option>";
    return $opcion;
}

function select_usuarios(){
    return "SELECT `login`, `nombre`, `apellidos` FROM `trabajadores` WHERE `activo` = 1";
}

function select_departamentos(){
    return "SELECT DISTINCT `departamento` FROM `trabajadores` WHERE `activo` = 1";
}

function select_turnos(){
    return "SELECT DISTINCT `turno` FROM `trabajadores` WHERE `activo` = 1";
}

function i_post($nombre){
    return filter_input(INPUT_POST, $nombre);
}