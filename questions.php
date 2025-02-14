<?php
include 'class/Database.php';

$categoryId = isset($_GET['id_category']) ? intval($_GET['id_category']) : 0;
$points = isset($_SESSION['points']) ? $_SESSION['points'] : 0;
$currentQuestionIndex = isset($_SESSION['currentQuestionIndex']) ? $_SESSION['currentQuestionIndex'] : 0;
$totalQuestionsAnswered = isset($_SESSION['totalQuestionsAnswered']) ? $_SESSION['totalQuestionsAnswered'] : 0;
//
if ($_POST) {
    $selectedAnswerId = isset($_POST['answer']) ? intval($_POST['answer']) : 0;
    $sql = "SELECT est_correct FROM reponses WHERE id = :answer_id";
    $selectedAnswer = $DB->query($sql, ['answer_id' => $selectedAnswerId])->fetch(PDO::FETCH_ASSOC);

    if ($selectedAnswer && $selectedAnswer['est_correct']) {
        $points++;
        $_SESSION['points'] = $points;
        $message = "Points : $points";
    }
    $totalQuestionsAnswered++;
    $_SESSION['totalQuestionsAnswered'] = $totalQuestionsAnswered;

    if ($totalQuestionsAnswered >= 10) {
        $message = "Terminé ! Vous avez un total de  $points points";
        session_destroy();
    } else {
        $currentQuestionIndex++;
        $_SESSION['currentQuestionIndex'] = $currentQuestionIndex;
    }
}

if ($categoryId > 0 && $totalQuestionsAnswered < 10) {
    $sql = "SELECT * FROM questions WHERE categorie_id = :category_id";
    $questions = $DB->query($sql, ['category_id' => $categoryId])->fetchAll(PDO::FETCH_ASSOC);
    $question = $questions[$currentQuestionIndex % count($questions)];
    $sql = "SELECT nom FROM categories WHERE id = :category_id";
    $category = $DB->query($sql, ['category_id' => $categoryId])->fetch(PDO::FETCH_ASSOC);
    // We get the correct answer first, then we select three other answers, and we randomize to prevent giving the correct answer at the first position
    // Fetch the correct answer
    $sql = "SELECT * FROM reponses WHERE question_id = :question_id AND est_correct = 1";
    $correctAnswer = $DB->query($sql, ['question_id' => $question['id']])->fetch(PDO::FETCH_ASSOC);

    // Fetch the remaining answers
    $sql = "SELECT * FROM reponses WHERE question_id = :question_id AND est_correct = 0 ORDER BY RAND() LIMIT 3";
    $incorrectAnswers = $DB->query($sql, ['question_id' => $question['id']])->fetchAll(PDO::FETCH_ASSOC);

    // Combine the correct answer with the incorrect answers
    $answers = array_merge([$correctAnswer], $incorrectAnswers);
    shuffle($answers); // Randomize the order of the answers
} else {
    $questions = [];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions - Night Quiz</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Corinthia:wght@400;700&family=League+Script&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar mobile">
            <div class="navbar-container">
                <input type="checkbox" id="navbar-toggle">
                <label for="navbar-toggle" class="navbar-icon">&#9776;</label>
                <div class="navbar-menu">
                    <a href="index.php">Accueil</a>
                    <a href="#about">About</a>
                    <a href="user.php">Profil</a>
                </div>
            </div>
        </nav>

        <nav class="navbar desktop">
            <div class="navbar-container">
                <input type="checkbox" id="navbar-toggle">
                <ul class="navbar-menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="user.php">Profil</a></li>
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li><a href="login.php">Connexion</a></li>
                        <li><a href="register.php">S'inscrire</a></li>
                    <?php else: ?>
                        <li><a href="#"><?= $_SESSION['username'] ?></a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <h1 class="neon-title neon-flashing">Quiz <span>Night</span></h1>
    </header>

    <main>
        <h2 class="neon-title neon-flashing"><?= $category['nom'] ?></h2>
        <div class="container">
            <?php if (!empty($questions) && $totalQuestionsAnswered < 10): ?>
                <?php if (isset($message)): ?>
                    <p><?= $message ?></p>
                <?php endif; ?>
                <form method="post">
                    <div class="question">
                        <h3 class="question"><?= htmlspecialchars($question['question_text']) ?></h3>
                    </div>

                    <div class="answers">
                        <?php foreach ($answers as $answer): ?>
                            <div class="answer">
                                <input type="radio" name="answer" id="answer<?= $answer['id'] ?>" value="<?= $answer['id'] ?>" required>
                                <label for="answer<?= $answer['id'] ?>"><?= htmlspecialchars($answer['reponse_text']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit">Envoyer la réponse</button>
                </form>
            <?php elseif ($totalQuestionsAnswered >= 10): ?>
                <p>Le quiz est terminé ! Vous avez  <?= $points ?> points</p>
            <?php else: ?>
                <p>Aucune question trouvée pour cette catégorie.</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>