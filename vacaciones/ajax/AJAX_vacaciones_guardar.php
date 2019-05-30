<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';
$link = conexion();

$login = filter_input(INPUT_POST, "login");
$f_ini = filter_input(INPUT_POST, "f_ini");
$f_fin = filter_input(INPUT_POST, "f_fin");

$sql = "INSERT INTO `vacaciones_solicitudes` VALUES ('$login',now(),'$f_ini','$f_fin')";
mysqli_query($link, $sql);
echo json_encode(mysqli_error($link));