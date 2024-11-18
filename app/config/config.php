<?php

class DBConnect {
    private $pdo;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=atm;charset=utf8mb4';
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
           $this->pdo = new PDO($dsn, 'atm', 'atm-pass', $options);
        } catch (Exception $e) {
            exit('Unable to connect to database.' . $e->getMessage()); 
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}