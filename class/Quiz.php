<?php
class Quiz {
    private $db; 
    private $categoryId; 
    private $points = 0;
    private $currentQuestionIndex; 
    private $totalQuestionsAnswered;

    // Constructor to initialize the attributes values ^
    public function __construct($db, $categoryId) {
        $this->db = $db;
        $this->categoryId = $categoryId;
        $this->points = isset($_SESSION['points']) ? $_SESSION['points'] : 0;
        $this->currentQuestionIndex = isset($_SESSION['currentQuestionIndex']) ? $_SESSION['currentQuestionIndex'] : 1;
        $this->totalQuestionsAnswered = isset($_SESSION['totalQuestionsAnswered']) ? $_SESSION['totalQuestionsAnswered'] : 0;
    }
    
    public function processAnswer($selectedAnswerId) {
        // Query to check if the selected answer is correct
        $sql = "SELECT est_correct FROM reponses WHERE id = :answer_id";
        $selectedAnswer = $this->db->query($sql, ['answer_id' => $selectedAnswerId])->fetch(PDO::FETCH_ASSOC);
        // If the answer is correct, increment points

        if ($selectedAnswer && $selectedAnswer['est_correct']) {
            $this->points++;
            $_SESSION['points'] = $this->points;
        }

        // Increment the total number of questions answered
        $this->totalQuestionsAnswered++;
        $_SESSION['totalQuestionsAnswered'] = $this->totalQuestionsAnswered;
        $message = "Points : {$this->points} </br> Question  {$this->currentQuestionIndex} / 10";


        // Check if the quiz is finished
        if ($this->totalQuestionsAnswered == 10) {
            $message = "Terminé ! Vous avez un total de {$this->points} points </br> Question {$this->totalQuestionsAnswered} / 10";

        } else {
            // Move to the next question
            $this->currentQuestionIndex++;
            $_SESSION['currentQuestionIndex'] = $this->currentQuestionIndex;
        }

        return $message;
    }

    public function getQuestion() {
        if ($this->categoryId > 0 && $this->totalQuestionsAnswered < 10) {
            // Query to get all questions in the selected category
            $sql = "SELECT * FROM questions WHERE categorie_id = :category_id";
            $questions = $this->db->query($sql, ['category_id' => $this->categoryId])->fetchAll(PDO::FETCH_ASSOC);
            // Get the current question based on the index
            $question = $questions[$this->currentQuestionIndex % count($questions)];
            return $question;
        }
        return null; 
    }


    public function getCategory() {
        // Query to get the category name
        $sql = "SELECT nom FROM categories WHERE id = :category_id";
        $category = $this->db->query($sql, ['category_id' => $this->categoryId])->fetch(PDO::FETCH_ASSOC);
        return $category;
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
        shuffle($answers); // Randomize the order of the answers

        return $answers; // Return the answers
    }

        public function getcurrentQuestionsAnswered() {
            return $this->currentQuestionIndex;
        }
    
        public function getPoints() {
            return $this->points;
        }
        public function getTotalQuestionsAnswered()
        {
            return $this->totalQuestionsAnswered;
        }

        public function resetQuizStats() {
            $this->points = 0;
            $this->currentQuestionIndex = 1;
            $this->totalQuestionsAnswered = 0;
            $_SESSION['points'] = 0;
            $_SESSION['currentQuestionIndex'] = 1;
            $_SESSION['totalQuestionsAnswered'] = 0;
        }

}      
?> 