<?php

class Category {
    private $db;
    private $id;
    private $name;

    public function __construct($db, $id = null) {
        $this->db = $db;
        $this->id = $id;
    }

    private function fetchCategory() {
        $sql = "SELECT nom FROM categories WHERE id = :category_id";
        $category = $this->db->query($sql, ['category_id' => $this->id])->fetch(PDO::FETCH_ASSOC);
        $this->name = $category['nom'];
    }

    public function fetchAll() {
        $sql = "SELECT * FROM categories";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name) {
        $sql = "INSERT INTO categories (nom) VALUES (:name)";
        $this->db->insert($sql, ['name' => $name]);
    }

    public function updateCategory($id, $newName) {
        $sql = "UPDATE categories SET nom = :name WHERE id = :id";
        $this->db->query($sql, ['name' => $newName, 'id' => $id]);
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}
?>