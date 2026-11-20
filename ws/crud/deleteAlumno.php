<?php

require_once "ws/connection/Connection.php";
require_once "ws/validators/validators.php";

function deleteAlumno(){

    //Objeto conexion para acceder a la base de datos
    $connection = new Connection();
    
    //Variable que contiene la query que queremos ejecutar
    $query = "DELETE FROM alumno where id = :id";

    //Variable para hacer todos los pasos para ejecutar la query
    $statement = "";

    //Variable que representa al id del objeto
    $id = 0;

    if (isset($_GET["id"])) {
        $id = validarId($_GET['id']);
    } else {
        return json_encode([
            "success" => false,
            "message" => "Variable id no valida",
        ]);
    }

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
            "data" => null
        ]);

    }catch (PDOException $e){
        return json_encode([
            "success" => false,
            "message" => "El alumno no ha sido posible eliminarlo, error: ". $e,
        ]);
    }

}