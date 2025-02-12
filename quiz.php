<?php
require_once "config.php"; 
require_once "quizz.php";

if (!isset($_GET['categorie'])) {
    die("Aucune catégorie sélectionnée.");
}

$categorie = $_GET['categorie'];
$quiz = new Quiz($pdo, $categorie);
$questions = $quiz->getQuestions();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?= $categorie ?></title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <div class="container">
        <h1>Quiz : <?= $categorie ?></h1>
        <?php if (empty($questions)) : ?>
            <p>Aucune question disponible pour cette catégorie.</p>
        <?php else : ?>
            <form action="resultat.php" method="post">
                <input type="hidden" name="categorie" value="<?= $categorie ?>">
                
                <?php foreach ($questions as $index => $question) : ?>
                    <div class="question">
                        <p><?= $question['question_text'] ?></p>
                        <input type="hidden" name="question_ids[]" value="<?= $question['id'] ?>">

                        <?php

                        $query = $pdo->prepare("SELECT * FROM reponses WHERE question_id = :question_id");
                        $query->execute(['question_id' => $question['id']]);
                        $reponses = $query->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($reponses as $reponse) : ?>
                            <label>
                                <input type="radio" name="reponse[<?= $index ?>]" value="<?= $reponse['id'] ?>" required>
                                <?= $reponse['reponse_text'] ?>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="submit-btn">Valider</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
