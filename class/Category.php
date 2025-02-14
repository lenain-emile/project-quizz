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
    

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}
?>