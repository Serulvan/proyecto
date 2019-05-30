<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';
$link = conexion();
$user = strtoupper(filter_input(INPUT_POST, "user"));
$pass = md5(filter_input(INPUT_POST, "pass"));

$sql = "SELECT `categoria`, `insertar_vac`, `gestionar_vac`, `anular_vac`, `reportes` FROM `trabajadores` t, `credenciales` c  WHERE t.`login` = '$user' AND `password`= '$pass' AND t.login = c.login";
$arr = lanzar_query($sql, $link, MYSQLI_ASSOC);
if ($arr != null) {
    $arr = $arr[0];
    $_SESSION["login_true"] = true;
    $_SESSION["user"] = $user;
    
    $_SESSION["categoria"] = $arr["categoria"];
    $_SESSION["insertar_vac"] = $arr["insertar_vac"];
    $_SESSION["gestionar_vac"] = $arr["gestionar_vac"];
    $_SESSION["anular_vac"] = $arr["anular_vac"];
    $_SESSION["reportes"] = $arr["reportes"];
    $login["entrar"] = 1;
}else{
    $login["entrar"] = 0;
}
echo json_encode($login);
