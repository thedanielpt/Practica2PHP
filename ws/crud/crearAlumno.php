<?php

require_once "ws/connection/Connection.php";

function crearAlumno(){

    //Objeto conexion para acceder a la base de datos
    $connection = new Connection();
    
    //Variable que contiene la query que queremos ejecutar
    $query = "INSERT INTO alumno (nombre, apellidos, password, telefono, email, sexo, fecha_nacimiento)
    VALUES (:nombre, :apellidos, :password, :telefono, :email, :sexo, :fecha_nacimiento)";

    //Variable para hacer todos los pasos para ejecutar la query
    $statement = "";

    if (!isset($_POST['nombre']) || Empty($_POST['nombre'])) {
        return json_encode([
            "success" => false,
            "message" => "Nombre no valida",
        ]);
    }

    $nombre = $_POST['nombre'];


    if (!isset($_POST['apellidos']) || empty($_POST['apellidos'])) {
        return json_encode([
            "success" => false,
            "message" => "Apellido no valida",
        ]);
    }

    $apellido = $_POST['apellidos'];


    if (!isset($_POST['password']) || empty($_POST['password']) || strlen($_POST['password']) < 8) {
        return json_encode([
            "success" => false,
            "message" => "Password no valida",
        ]);
    }

    $password = $_POST['password'];

    $telefono = $_POST['telefono'] ?? null;

    $sexo = $_POST['sexo'] ?? null;

    $email = $_POST['email'] ?? null;

    if (empty($_POST['fecha'])) {
        return json_encode([
            "success" => false,
            "message" => "No se encuentra la fecha",
        ]);
    }

    $fecha = $_POST['fecha'];

    try {
        $statement = $connection->getConnection()->prepare($query);

        $statement->bindParam(":nombre", $nombre);
        $statement->bindParam(":apellidos", $apellido);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":telefono", $telefono);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":sexo", $sexo);
        $statement->bindParam(":fecha_nacimiento", $fecha);

        $statement->execute();

        return json_encode([
            "success" => true,
            "message" => "Usuairo creado correctamente",
        ]);

    }catch (PDOException $e){
        return json_encode([
            "success" => false,
            "message" => "El alumno no ha sido posible crearlo, error: ". $e->getMessage(),
        ]);
    }
}