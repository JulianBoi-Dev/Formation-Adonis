<?php

class PDOModel{
    private $host = "localhost";
    private $dbname = "base_test";
    private $user = "root";
    private $pass = "";

    public $pdo;

    public function __construct($host = "localhost", $dbname = "base_test", $user = "root", $pass = "") {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
        
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}