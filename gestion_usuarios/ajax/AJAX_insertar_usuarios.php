<?php

session_start();
include_once '../../conex/conex.php';
include_once '../../php/funciones.php';

$link = conexion();
$brray = filter_input(INPUT_POST, 'arr', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
foreach ($brray as $value) {
    $array[] = array_map('strtoupper',$value);
}
$sql = "REPLACE INTO `trabajadores` VALUES ";
for ($i = 0; $i < count($array); $i++) {
    $sql.="(";
    for ($j = 0; $j < count($array[$i]); $j++) {
        $end = ",'1'";
        if (count($array[$i]) > $j+1) {
            $end = ",";
        }
        $sql.= "'".$array[$i][$j]."'$end";
    }
    $end = "";
    if (count($array) > $i+1) {
        $end = ",";
    }
    $sql.=")$end";
}

mysqli_query($link, $sql);
if (mysqli_error($link)) {
    echo mysqli_error($link);
}else {
    echo "1";
}