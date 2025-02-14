<?php

class Question {
    private $db;
    private $categoryId;

    public function __construct($db, $categoryId) {
        $this->db = $db;
        $this->categoryId = $categoryId;
    }

    public function getQuestion($currentQuestionIndex, $totalQuestionsAnswered) {
        if ($this->categoryId > 0 && $totalQuestionsAnswered < 10) {
            // Query to get all questions in the selected category
            $sql = "SELECT * FROM questions WHERE categorie_id = :category_id";
            $questions = $this->db->query($sql, ['category_id' => $this->categoryId])->fetchAll(PDO::FETCH_ASSOC);
            // Get the current question based on the index
            $question = $questions[$currentQuestionIndex % count($questions)];
            return $question;
        }
        return null;
    }

    public function getAnswers($questionId) {
        // Fetch the correct answer
        $sql = "SELECT * FROM reponses WHERE question_id = :question_id AND est_correct = 1";
        $correctAnswer = $this->db->query($sql, ['question_id' => $questionId])->fetch(PDO::FETCH_ASSOC);

        // Fetch the remaining incorrect answers
        $sql = "SELECT * FROM reponses WHERE question_id = :question_id AND est_correct = 0 ORDER BY RAND() LIMIT 3";
        $incorrectAnswers = $this->db->query($sql, ['question_id' => $questionId])->fetchAll(PDO::FETCH_ASSOC);

        // Combine the correct answer with the incorrect answers
        $answers = array_merge([$correctAnswer], $incorrectAnswers);
        shuffle($answers);

        return $answers; 
    }

    public function addQuestion($questionText, $category) {
        $sql = "INSERT INTO `questions` (`categorie_id`, `question_text`) VALUES (:category, :questionText)";
        $this->db->insert($sql, [
            ':questionText' => $questionText,
            ':category' => $category
        ]);
        return $this->db->lastInsertId();
    }

    public function addResponse($question_id, $response_text, $is_correct) {
        if (empty($response_text)) {
            throw new InvalidArgumentException('Response text cannot be empty.');
        }

        $sql = "INSERT INTO `reponses` (`question_id`, `reponse_text`, `est_correct`) VALUES (:question_id, :response_text, :is_correct)";
       $this->db->insert($sql, [
            ':question_id' => $question_id,
            ':response_text' => $response_text,
            ':is_correct' => $is_correct
        ]);
       
    }
}
?>