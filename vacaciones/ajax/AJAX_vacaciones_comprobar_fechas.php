<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';
$link = conexion();
$login = filter_input(INPUT_POST, "login");
$f_ini = filter_input(INPUT_POST, "f_ini");
$f_fin = filter_input(INPUT_POST, "f_fin");

$sql = "
SELECT * FROM `vacaciones_solicitudes`
WHERE 
(('$f_ini'<=`fecha_fin` AND `fecha_fin`<='$f_fin')
OR
('$f_ini'<=`fecha_ini` AND `fecha_ini`<='$f_fin')
OR
(`fecha_ini`<='$f_ini' AND '$f_fin'<=`fecha_fin`))
AND `login`= '$login'";

echo json_encode(lanzar_query($sql, $link));