<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include_once 'class/Database.php';
include_once 'class/Question.php';
include_once 'class/Category.php';

$db = new Database();
$questionId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$question = new Question($db, null); // Pass null for categoryId as it's not needed here
$questionData = $question->getQuestionById($questionId);
$answers = $question->getAnswersByQuestionId($questionId);
$categories = new Category($db);
$categories = $categories->fetchAll();

// Set the correct answer as first in the array
usort($answers, function($answerA, $answerB) {
    return $answerB['est_correct'] - $answerA['est_correct'];
});

if ($_POST) {
    $questionText = $_POST['Question'];
    $category = $_POST['category'] ?? null;
    if ($category) {
        $question->updateQuestion($questionId, $questionText);

        // Update answers
        foreach ($answers as $index => $answer) {
            $answerText = $_POST['choix' . ($index + 1)];
            $isCorrect = ($index == 0) ? 1 : 0; // The first answer is the correct one
            $question->updateAnswer($answer['id'], $answerText, $isCorrect);
        }

        echo "Question mise à jour avec succès !";
        header('Location: adminPage.php');
        exit;
    } else {
        echo "Veuillez sélectionner une catégorie.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mettre à jour une question à Quizz Night - Testez vos connaissances !">
    <title>Quizz Night - Mettre à jour une question</title>
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
        <h1>Mettre à jour une question</h1>
    </header>

    <main>
        <form method="post" action="" class="neon-flashing-box">
            <div class="form-group">
                <label for="category">Choisis une catégorie:</label>
                <select name="category" id="category" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $questionData['categorie_id']) echo 'selected'; ?>><?php echo $category['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Question">Question:</label>
                <textarea name="Question" id="Question" required><?= htmlspecialchars($questionData['question_text']) ?></textarea>
            </div>
            <?php foreach ($answers as $index => $answer) { ?>
                <div class="form-group">
                    <label for="choix<?= $index + 1 ?>">Choix <?= $index + 1 ?>:</label>
                    <input type="text" name="choix<?= $index + 1 ?>" id="choix<?= $index + 1 ?>" value="<?= htmlspecialchars($answer['reponse_text']) ?>" required>
                </div>
            <?php } ?>
            <div class="form-group">
                <button type="submit" class="neon-flashing-box">Mettre à jour la question</button>
            </div>
        </form>
    </main>
</body>

</html>