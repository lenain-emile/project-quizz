<?php
session_start();

include 'class/Database.php';
include 'class/Quiz.php';
include 'class/Question.php';


$categoryId = isset($_GET['id_category']) ? intval($_GET['id_category']) : 0;
$db = new Database();
$quiz = new Quiz($db, $categoryId);

if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    Quiz::resetQuiz();
    header("Location: questions.php?id_category=$categoryId");
    exit;
}
if ($_POST) {
    $selectedAnswerId = isset($_POST['answer']) ? intval($_POST['answer']) : 0;
    $message = $quiz->processAnswer($selectedAnswerId);
    $_SESSION['message'] = $message;
    header("Location: questions.php?id_category=$categoryId");
    exit;
}

$question = $quiz->getQuestion();
$category = $quiz->getCategory();
$answers = $question ? $quiz->getAnswers($question['id']) : [];

$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
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
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <a href="login.php">Connexion</a>
                        <a href="register.php">S'inscrire</a>
                    <?php } else { ?>
                        <a href="adminPage.php"><?= "Page d'administration" ?></a>
                        <a href="deconnexion.php">Déconnexion</a>
                    <?php } ?>
                </div>
            </div>
        </nav>

        <nav class="navbar desktop">
            <div class="navbar-container">
                <input type="checkbox" id="navbar-toggle">
                <ul class="navbar-menu">
                    <li><a href="index.php">Accueil</a></li>
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <li><a href="login.php">Connexion</a></li>
                        <li><a href="register.php">S'inscrire</a></li>
                    <?php } else { ?>
                        <li><a href="adminPage.php"><?= "Page d'administration" ?></a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <h1 class="neon-title neon-flashing">Quiz <span>Night</span></h1>
    </header>

    <main>
        <h2 class="neon-title neon-flashing"><?= $category['nom'] ?></h2>
        <div class="container-questions">
            <?php if (!empty($question) && $quiz->getTotalQuestionsAnswered() < 10) { ?>
                <?php if (isset($message)) {
                    echo "<p>$message</p>";
                } ?>

                <p>Points: <?= $quiz->getPoints() ?></p>
                <p>Question: <?= $quiz->getTotalQuestionsAnswered() + 1 ?> / 10</p>

                <form method="post">
                    <div class="question">
                        <h3 class="question"><?= htmlspecialchars($question['question_text']) ?></h3>
                    </div>

                    <div class="answers">
                        <?php foreach ($answers as $answer) { ?>
                            <div class="answer">
                                <input type="radio" name="answer" id="answer<?= $answer['id'] ?>" value="<?= $answer['id'] ?>" required>
                                <label for="answer<?= $answer['id'] ?>"><?= htmlspecialchars($answer['reponse_text']) ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit">Envoyer la réponse</button>
                </form>
            <?php } elseif ($quiz->getTotalQuestionsAnswered() >= 10) { ?>
                <p>Le quiz est terminé ! Vous avez <?= $quiz->getPoints() ?> points</p>
                <a href="index.php" class="button">Retour à l'accueil</a>
                <a href="questions.php?id_category=<?= $categoryId ?>&reset=1" class="button">Recommencer le quiz</a> <?php } else { ?>
                <p>Aucune question trouvée pour cette catégorie.</p>
            <?php } ?>
        </div>
    </main>
</body>

</html>