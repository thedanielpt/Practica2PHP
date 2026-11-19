<?php

require_once "ws/models/Alumno.php";
require_once "ws/connection/Connection.php";
require_once "ws/crud/getAlumno.php";

function modifyAlumno(){

    //Array que contiene los campos que queremos modificar
    $campos = [];

    //Objeto conexion para acceder a la base de datos
    $connection = new Connection();

    //Variable donde se guarara el objeto alumno
    $alumno = "";
    //Convertimos el json en un array asociativo de php
    $datos = json_decode(getAlumno(), true);

    //Variable que contiene la query que queremos ejecutar
    $query = "UPDATE alumno SET ";

    //Variable para hacer todos los pasos para ejecutar la query
    $statement = "";

    //Te devuelve 16 claves del $datos['data'], ya qeu tambien esta el Array asociativo y el numérico
    if (!isset($datos['data']) || count($datos['data']) !== 16){
        return json_encode([
            "success" => false,
            "message" => "No se ha encontrado al alumno que se quiere modificar",
        ]);
    } else {
        $datosAlumno = $datos['data'];
        $alumno = new Alumno( $datosAlumno['id'], $datosAlumno['nombre'], 
            $datosAlumno['apellidos'], $datosAlumno['password'], $datosAlumno['telefono'], 
            $datosAlumno['email'], $datosAlumno['sexo'], $datosAlumno['fecha_nacimiento']
        );
    }

    //Estas variables sirven para comprobar que parametros por POST nos han pasado
    $nuevoNombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : null;
    $nuevoApellido = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : null;
    $nuevaPassword = (isset($_POST['password'])) ? $_POST['password'] : null;
    $nuevoTelefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : null;
    $nuevoEmail = (isset($_POST['email'])) ? $_POST['email'] : null;
    $nuevoSexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : null;
    $nuevoFecha_nacimiento = (isset($_POST['fecha'])) ? $_POST['fecha'] : null;

    if ($nuevoNombre !== null && !empty($nuevoNombre)) {
        if ($nuevoNombre !== $alumno->getNombre()) {
            $campos[] = "nombre = :nombre";
        } else {
            return json_encode([
                "success" => false,
                "message" => "El nombre proporcionado no cumple con los requisitos de validacion."
            ]);
        }
    }

    if ($nuevoApellido !== null && !empty($nuevoApellido)) {
        if ($nuevoApellido !== $alumno->getApellidos()) {
            $campos[] = "apellidos = :apellidos";
        } else {
            return json_encode([
                "success" => false,
                "message" => "Los apellidos proporcionados no cumplen con los requisitos de validacion."
            ]);
        }
    }

    if ($nuevaPassword !== null && !empty($nuevaPassword)) {
        if (validarPassword($nuevaPassword) && $nuevaPassword !== $alumno->getPassword()) {
            $campos[] = "password = :password";
        } else {
            return json_encode([
                "success" => false,
                "message" => "La contrasena proporcionada no cumple con los requisitos de validacion."
            ]);
        }
    }

    if ($nuevoFecha_nacimiento !== null) {
        if ($nuevoFecha_nacimiento !== $alumno->getFechaNacimiento()) {
            $campos[] = "fecha_nacimiento = :fecha";
        } else {
            return json_encode([
                "success" => false,
                "message" => "La fecha de nacimiento proporcionada no cumple con los requisitos de validacion."
            ]);
        }
    }

    (isset($_POST['telefono'])) ? $campos[] = "telefono = :telefono" : "";
    (isset($_POST['email'])) ? $campos[] = "email = :email" : "";
    (isset($_POST['sexo'])) ? $campos[] = "sexo = :sexo" : "";

    try {
        $query = "UPDATE alumno SET " . implode(", ", $campos) . " WHERE id = :id";

        $statement = $connection->getConnection()->prepare($query);
        
        $statement->bindParam(":id", $_GET['id']);

        (isset($_POST['nombre'])) ? $statement->bindParam(":nombre", $nuevoNombre) : "";
        (isset($_POST['apellidos'])) ? $statement->bindParam(":apellidos", $nuevoApellido) : "";
        (isset($_POST['password'])) ? $statement->bindParam(":password", $nuevaPassword) : "";
        (isset($_POST['telefono'])) ? $statement->bindParam(":telefono", $nuevoTelefono) : "";
        (isset($_POST['email'])) ? $statement->bindParam(":email", $nuevoEmail) : "";
        (isset($_POST['sexo'])) ? $statement->bindParam(":sexo", $nuevoSexo) : "";
        (isset($_POST['fecha'])) ? $statement->bindParam(":fecha", $nuevoFecha_nacimiento) : "";

        $statement->execute();

        return json_encode([
            "success" => true,
            "message" => "El alumno se ha modificado correctamente."
        ]);

    } catch (PDOException $e){
        return json_encode([
            "success" => false,
            "message" => "Error al modificar el alumno. Error: " . $e->getMessage()
        ]);
    }
    
}