<?php
class Question {
    private $db;
    private $id;
    private $text;
    private $categoryId;

    public function __construct($db, $id) {
        $this->db = $db;
        $this->id = $id;
        $this->fetchQuestion();
    }

    private function fetchQuestion() {
        $sql = "SELECT * FROM questions WHERE id = :question_id";
        $question = $this->db->query($sql, ['question_id' => $this->id])->fetch(PDO::FETCH_ASSOC);
        $this->text = $question['question_text'];
        $this->categoryId = $question['categorie_id'];
    }

    public function getText() {
        return $this->text;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }
}
?>