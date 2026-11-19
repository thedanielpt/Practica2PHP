<?php

require_once "ws/interfaces/IToJson.php";

class Alumno implements IToJson{

    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $password;
    private ?string $telefono;
    private ?string $email;
    private ?string $sexo;
    private string $fecha_nacimiento;

    public function __construct(int $id, string $nombre, string $apellidos, string $password, ?string $telefono, ?string $email, 
    ?string $sexo, string $fecha_nacimiento) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    #[Override]
    public function toJson() {
        return json_encode([
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellidos" => $this->apellidos,
            "contrasena" => $this->password,
            "telefono" => $this->telefono,
            "mail" => $this->email,
            "sexo" => $this->sexo,
            "fecha_nacimiento" => $this->fecha_nacimiento
        ]);
    }
}


    
