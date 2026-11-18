<?php

require_once "ws/connection/Connection.php";

function deleteAlumno(){

    if (!isset($_GET["id"])) {
        return json_encode([
            "success" => false,
            "message" => "Variable id no encontrada",
        ]);
    }

    $id = $_GET["id"];

    //Objeto conexion para acceder a la base de datos
    $connection = new Connection();
    
    //Variable que contiene la query que queremos ejecutar
    $query = "DELETE FROM alumno where id = :id";

    //Variable para hacer todos los pasos para ejecutar la query
    $statement = "";

    try {
        $statement = $connection->getConnection()->prepare($query);

        $statement->bindParam(":id", $id);

        $statement->execute();

        //SI no se ha podido eliminar ningun usuario, aparecera este mensaje, ya que no devuelve ningun row
        if ($statement->rowCount() === 0) {
            return json_encode([
                "success" => false,
                "message" => "El alumno no existe en la base de datos"
            ]);
        }

        return json_encode([
            "success" => true,
            "message" => "Usuairo eliminado correctamente",
        ]);

    }catch (PDOException $e){
        return json_encode([
            "success" => false,
            "message" => "El alumno no ha sido posible eliminarlo, error: ". $e,
        ]);
    }

}