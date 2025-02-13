<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'quizz';
    private $user = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function getCategories() {
        $query = 'SELECT id, nom FROM categories'; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addQuestion($question, $category) {
        $query = "INSERT INTO `questions` (`categorie_id`, `question_text`) VALUES (:category, :question)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':question' => $question,
            ':category' => $category
        ]);
        return $this->pdo->lastInsertId();
    }

    public function addResponse($question_id, $response_text, $is_correct) {
        if (empty($response_text)) {
            throw new InvalidArgumentException('Response text cannot be empty.');
        }

        $query = "INSERT INTO `reponses` (`question_id`, `reponse_text`, `est_correct`) VALUES (:question_id, :response_text, :is_correct)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':question_id' => $question_id,
            ':response_text' => $response_text,
            ':is_correct' => $is_correct
        ]);
    }
}


