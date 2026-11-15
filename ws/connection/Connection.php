<?php

require_once "ws/variables/Const.php";

class Connection {

    private $connection;

    function __construct(){
        try {
            $this->connection = new PDO(dbType .":host=" . host . ";dbname=" . dbName,dbUser,dbPassw);
        } catch (PDOException $e) {
            throw new Exception(
                json_encode([
                    "success" => false,
                    "message" => "Error de conexión: " . $e->getMessage(),
                    "data" => []
                ]),
            );
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}