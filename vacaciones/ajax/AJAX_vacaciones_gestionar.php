<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$tipo = i_post("tipo");
$login = i_post("login");
$f_sol = i_post("fecha_solicitud");
$f_ini = i_post("fecha_ini");
$f_fin = i_post("fecha_fin");
$drwho = i_post("drwho");

if ($tipo>-1) {
    $gestion = 'CONFIRMADO';
}else{
    $gestion = 'RECHAZADO';
}

$sql = "INSERT INTO `vacaciones_gestionadas` "
        . "SELECT *, UPPER('$gestion') AS estado, now() AS fecha_gestion, '$drwho' as usuario_gestiona "
        . "FROM vacaciones_solicitudes "
        . "WHERE login = '$login' AND fecha_solicitud = '$f_sol' AND fecha_ini = '$f_ini' AND fecha_fin = '$f_fin'";

$link = conexion();

if (mysqli_query($link, $sql)) {
    echo json_encode("1");
}else{
    echo json_encode(mysqli_error($link));
}