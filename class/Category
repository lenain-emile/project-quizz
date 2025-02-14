<?php

class Category {
    private $db;
    private $id;
    private $name;

    public function __construct($db, $id) {
        $this->db = $db;
        $this->id = $id;
        $this->fetchCategory();
    }

    private function fetchCategory() {
        $sql = "SELECT nom FROM categories WHERE id = :category_id";
        $category = $this->db->query($sql, ['category_id' => $this->id])->fetch(PDO::FETCH_ASSOC);
        $this->name = $category['nom'];
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}
?>