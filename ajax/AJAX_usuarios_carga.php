<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';

$link = conexion();
$sql = "SELECT `login`, `nombre`, `apellidos` FROM `trabajadores` WHERE `activo` = 1";
echo json_encode(lanzar_query($sql, $link, MYSQLI_ASSOC));

