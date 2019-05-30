<?php

session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$login = i_post("login");
$departamento = i_post("departamento");
$turno = i_post("turno");
$gestion = i_post("gestion");
$tipo = i_post("tipo");
$f_ini = i_post("f_ini");
$f_fin = i_post("f_fin");
$f_ini_s = i_post("f_ini_s");
$f_fin_s = i_post("f_fin_s");
$f_ini_g = i_post("f_ini_g");
$f_fin_g = i_post("f_fin_g");

$and = "";
if ($login != "@") {
    $and = " AND login = '$login'";
}

if ($departamento != "@") {
    $and = " AND departamento = '$departamento'";
}

if ($turno != "@") {
    $and = " AND turno = '$turno'";
}

if ($gestion != "@") {
    $and = " AND estado = '$gestion'";
}

switch ($tipo) {
    case "D":
        $and .= " AND fecha_ini = fecha_fin";
        break;
    case "S":
        $and .= " AND fecha_ini <> fecha_fin";
        break;
}

if ($f_ini_s != "") {
    $and = " AND fecha_solicitud >= '$f_ini_s'";
}

if ($f_fin_s != "") {
    $and = " AND fecha_solicitud <= '$f_fin_s'";
}

if ($f_ini_g != "") {
    $and = " AND fecha_gestion >= '$f_ini_g'";
}

if ($f_fin_g != "") {
    $and = " AND fecha_gestion <= '$f_fin_g'";
}

if ($f_ini != "") {
    if ($f_fin != "") {
        $and = " AND (('$f_ini'<=`fecha_fin` AND `fecha_fin`<='$f_fin')
                OR
                ('$f_ini'<=`fecha_ini` AND `fecha_ini`<='$f_fin')
                OR
                (`fecha_ini`<='$f_ini' AND '$f_fin'<=`fecha_fin`))";
    }else{
        $and = " AND '$f_ini'<=`fecha_fin`";
    }
} else if ($f_fin != ""){
    $and = " AND `fecha_ini`<='$f_fin'";
}

$sql = "
SELECT * FROM (
SELECT vs.*,
IFNULL(`estado`, 'PENDIENTE') AS estado,
IFNULL(`fecha_gestion`, '-') AS fecha_gestion,
IFNULL(`usuario_gestiona`, '-') AS usuario_gestiona,
t.nombre,
t.apellidos,
t.departamento,
t.fecha_antiguedad,
t.categoria,
t.turno
FROM vacaciones_solicitudes vs 
LEFT JOIN vacaciones_gestionadas vg 
ON vs.login = vg.login 
AND vs.fecha_solicitud = vg.fecha_solicitud 
AND vs.fecha_ini = vg.fecha_ini 
AND vs.fecha_fin = vg.fecha_fin 
LEFT JOIN trabajadores t
ON t.login = vs.login) AS a
WHERE 1
$and
ORDER BY fecha_antiguedad ASC, fecha_ini DESC";
$link = conexion();
echo json_encode(lanzar_query($sql, $link, MYSQLI_ASSOC));
