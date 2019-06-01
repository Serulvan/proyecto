<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';
$link = conexion();
$arr = lanzar_query(select_usuarios(),$link);
$opciones = "";
for ($i = 0; $i < count($arr); $i++) {
    $opciones .= opciones($arr[$i][0], $arr[$i][0], $arr[$i][1], $arr[$i][2]);
}

echo json_encode($opciones);