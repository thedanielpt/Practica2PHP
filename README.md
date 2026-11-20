# Practica2PHP

*** INTRODUCCION ***
Practica de Práctica de proyecto | MYSQL de Desarrollo Web en Entorno Servidor.
En esta practica se ha hecho un CRUD con sus validaciones y su conexion a la base de datos

*** ESTRUCTURA ***

ws/
├── connection/
│   └── Connection.php
│
├── crud/
│   ├── createAlumno.php
│   ├── deleteAlumno.php
│   ├── getAlumno.php
│   └── modifyAlumno.php
│
├── interfaces/
│   └── IToJson.php
│
├── models/
│   └── Alumno.php
│
├── validators/
│   └── validators.php
│
└── variables/
    └── Const.php
index.php
README.md

*** Variables de la base de datos ***
En esta ruta:

└── variables/
    └── Const.php

Estan todas las variables para conectarse a la base de datos:

const dbType = Tipo de base de datos;
const host = Host de la base de datos
const dbName = Nombre de la base de datos
const dbUser = Usuario de la base de datos
const dbPassw = Contraseña de la base de datos

*** Requisitos ***

Para ejecutar el proyecto es necesario disponer de:

PHP
Un servidor local como XAMPP o MAMP
UN cliente, como puede ser POstMan

*** Respuestas JSON ***

El codigo siempre devuelve una respuesta en formato JSON, el caul tiene esta estructura:

#Si no ha habido ningun error, no siempre se manda un data en el json:

{
    "success": true,
    "message": "El alumno se ha modificado correctamente.",
    "data": $algo
}

#Si hubo un error:

{
    "success": false,
    "message": "El alumno se ha modificado correctamente."
}