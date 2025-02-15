<?php

namespace Models;

use PDO;
use PDOException;

class DB
{
    public static function connect(){
        $dsn = "mysql:host=localhost;dbname=gestion_equipos";
        $user = "root";
        $password = "";

        try{
            return new PDO($dsn, $user, $password);
        }catch (PDOException $e){
            echo "Fallo al conectar a la base de datos.";
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
        }
    }
}