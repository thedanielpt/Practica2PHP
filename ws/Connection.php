<?php

require_once 'variables/Const.php';

class Connection {

    function __construct(){
        $pdo = new PDO(dbType .":host=" . host . ";dbname=" . dbName,dbUser,dbPassw);
    }

}