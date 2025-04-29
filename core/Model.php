<?php

abstract class Model {

    protected ?PDO $db = null;

    public function __construct() {
        if ($this->db === null) {
            try {
                $dbtype  = Config::get('db.dbtype', 'mysql');
                $host    = Config::get('db.host', '');
                $port    = Config::get('db.port', '3308');
                $dbname  = Config::get('db.dbname');
                $charset = Config::get('db.charset', 'utf8');

                $user = Config::get('db.user', '');
                $pass = Config::get('db.pass', '');

                $dsn = "{$dbtype}:host={$host};port={$port};dbname={$dbname};charset={$charset}";

                $this->db = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
    }

    public function __destruct() {
        $this->db = null;
    }

}
