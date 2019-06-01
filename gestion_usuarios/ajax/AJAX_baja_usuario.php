<?php
session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$drwho = i_post("drwho");

$link = conexion();

$sql = "UPDATE `trabajadores` SET `activo`= 0 WHERE `login` = '$drwho'";

mysqli_query($link, $sql);
if (mysqli_error($link)) {
    echo mysqli_error($link);
}else{
    echo '1';
}