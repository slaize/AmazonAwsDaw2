<?php

namespace App\Helper;


class DbHelper{
    var $db;

    function __construct()
    {
        // 🡇 Conexión con control de errores
        $opciones = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=cms', 'cms', 'toor', $opciones);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }


}