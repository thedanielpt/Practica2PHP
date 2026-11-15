<?php

require_once "ws/crud/getAlumno.php";

try {

    getUsuario();

} catch (Exception $e){
    throw new ErrorException(json_encode([
        "success" => false,
        "message" => "Error de conexion, ". $e->getMessage(),
        "data" => []
    ]));
}