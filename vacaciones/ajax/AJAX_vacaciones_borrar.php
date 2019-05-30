<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$link = conexion();
$login = i_post("login");
$fsol = i_post("fsol");
$fini = i_post("fini");
$ffin = i_post("ffin");

$sql = "DELETE FROM `vacaciones_solicitudes` WHERE '$login' = `login` AND '$fsol' = `fecha_solicitud` AND '$fini' = `fecha_ini` AND '$ffin' = `fecha_fin`";
mysqli_query($link, $sql);

if (mysqli_error($link)) {
    echo mysqli_error($link);
}else {
    echo "1";
}