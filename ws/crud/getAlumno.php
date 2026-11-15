<?php

require_once "ws/connection/Connection.php";

//Se le pone ? para que pueda ser null el parametro
function getUsuario(?int $id = null){

    //Variable que contiene los datos qeu hemos pedido al servidor
    $datos = "";

    //Objeto conexion para acceder a la base de datos
    $connection = new Connection();
    
    //Variable que contiene la query que queremos ejecutar
    $query = "SELECT * FROM alumno";

    //Variable para hacer todos los pasos para ejecutar la query
    $statement = "";
    try {
        if ($id === null){
        
            $statement = $connection->getConnection()->prepare($query);

        } else {
            $query = 'SELECT * FROM alumno where id = :id';

            $statement = $connection->getConnection()->prepare($query);

            $statement->bindParam(":id", $id);

        }
    } catch (Exception $e){
        return json_encode([
            "success" => false,
            "message" => "Error al intentar utilizar la query, ". $e->getMessage(),
            "data" => []
        ]);
    }
    

    try {
        $statement->execute();

        $datos = ($id === null) ? $datos = $statement->fetchAll() : $datos = $statement->fetch();

        return json_encode([
            "success" => true,
            "message" => "Informacion obtenida",
            "data" => $datos
        ]);
    } catch (Exception $e) {
        return json_encode([
            "success" => false,
            "message" => "Error al recoger los datos, ". $e->getMessage(),
            "data" => []
        ]);
    }

}