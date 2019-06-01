<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$login = filter_input(INPUT_POST, "login");
$fecha = filter_input(INPUT_POST, "fecha");
$tipo = filter_input(INPUT_POST, "tipo");
$and = "";
if ($login!=null && $login!="") {
    $and = "AND vs.login = '$login'";
}
switch ($tipo) {
    case "D":
        $and.= "AND vs.fecha_ini = vs.fecha_fin";
        break;
    case "S":
        $and.= "AND vs.fecha_ini <> vs.fecha_fin";
        break;
}

$sql = "SELECT vs.*,
IFNULL(`estado`, 'PENDIENTE') AS estado,
IFNULL(`fecha_gestion`, '-') AS fecha_gestion,
IFNULL(`usuario_gestiona`, '-') AS usuario_gestiona 
FROM vacaciones_solicitudes vs 
LEFT JOIN vacaciones_gestionadas vg 
ON vs.login = vg.login 
AND vs.fecha_solicitud = vg.fecha_solicitud 
AND vs.fecha_ini = vg.fecha_ini 
AND vs.fecha_fin = vg.fecha_fin 
WHERE '$fecha' = year(vs.fecha_ini)
$and";
$link = conexion();
echo json_encode(lanzar_query($sql, $link));