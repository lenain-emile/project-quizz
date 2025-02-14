<?php

require_once 'database.php';

class AddCategories {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function addCategory($nom) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO categories (nom) VALUES (:nom)");
            $stmt->bindParam(':nom', $nom);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}

?>