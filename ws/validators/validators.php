
<?php

function validarId($id) {

    // Se carga todos los decimales y los que no son números
    if (ctype_digit((string) $id) && $id > 0) {
        return $id;
    }

    return 0;
}

function validarNombre(string $nombre) {

    if (empty($nombre)) {
        return false;
    }

    return true;
}

function validarApellidos(string $apellidos) {

    if (empty($apellidos)) {
        return false;
    }

    return true;
}

function validarPassword(string $password) {

    if (empty($password) || strlen($password) < 8) {
        return false;
    }

    return true;
}

function validarFecha(string $fecha) {

    if (empty($fecha)) {
        return false;
    }

    return true;
}
