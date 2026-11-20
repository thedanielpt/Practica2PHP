
<?php

function validarId(string $id) {
    return (ctype_digit((string) $id) && $id > 0) ? $id : 0;
}

function validarNombre(string $nombre) {
    return !empty($nombre);
}

function validarApellidos(string $apellidos) {
    return !empty($apellidos);
}

function validarPassword(string $password) {
    return !empty($password) && strlen($password) >= 8;
}

function validarFecha(string $fecha) {
    return !empty($fecha);
}

//sirve apraa validar si se tiene que modificar ese parametro del objeto
//Se le pone el $nuevo !== null porque en el modificar deulve null si no lo han pasado como parametro
//Se le pone la minterrogacion par que deje entra a null
Function validarModifcar(?string $nuevo){
    return $nuevo !== null && !empty($nuevo);
}