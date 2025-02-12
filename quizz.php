<?php
require_once "config.php"; 

class Quiz {
    private $pdo;
    private $categorie;
    
    public function __construct($pdo, $categorie) {
        $this->pdo = $pdo;
        $this->categorie = $categorie; 
    }

    public function getQuestions($limit = 5) {
        $query = $this->pdo->prepare("SELECT id FROM categories WHERE nom = :categorie");
        $query->execute(['categorie' => $this->categorie]);
        $categorieData = $query->fetch(PDO::FETCH_ASSOC);

        if (!$categorieData) {
            return []; 
        }

        $categorie_id = $categorieData['id'];

        $query = $this->pdo->prepare("SELECT * FROM questions WHERE categorie_id = :categorie_id ORDER BY RAND() LIMIT $limit");
        $query->execute(['categorie_id' => $categorie_id]);
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

