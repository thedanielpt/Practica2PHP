<?php

require_once "ws/Connection.php";

try {

    $pdo = new Connection();

} catch (Exception $e){
    return json_encode([
        "success" => false,
        "message" => "Error de conexion, ". $e->getMessage(),
        "data" => []
    ]);
}