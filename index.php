<?php

require_once "ws/crud/getAlumno.php";
require_once "ws/crud/deleteAlumno.php";

try {

    //echo getUsuario();

    echo deleteAlumno();

} catch (Exception $e){
    throw new ErrorException(json_encode([
        "success" => false,
        "message" => "Error de conexion, ". $e->getMessage(),
        "data" => []
    ]));
}