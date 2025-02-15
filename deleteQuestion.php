<?php
include_once 'class/Database.php';
include_once 'class/Question.php';

$db = new Database();
$questionId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$question = new Question($db, null); // Pass null for categoryId as it's not needed here
var_dump($questionId);
if ($questionId) {
    $question->deleteQuestion($questionId);
    echo "Question supprimée avec succès !";
    header('Location: adminPage.php');
    exit;
}
