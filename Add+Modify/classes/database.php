<?php

class Database {
    protected $pdo;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=quizz';
        $username = 'root';
        $password = '';
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>