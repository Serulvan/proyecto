<?php
function conexion(){
    $serv = filter_input(INPUT_SERVER, "REMOTE_ADDR");
    $usua = "conex";
    $cont = "1234";
    $bbdd = "proyecto";
    $link = mysqli_connect($serv, $usua, $cont, $bbdd);
    mysqli_query($link, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    return $link;
}