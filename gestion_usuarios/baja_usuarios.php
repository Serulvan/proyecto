<?php
session_start();
include_once '../conex/conex.php';
include_once '../php/funciones.php';

if (!isset($_SESSION["login_true"]) || $_SESSION["login_true"] == false) {
    header("location: /proyecto/index.php", true);
}

