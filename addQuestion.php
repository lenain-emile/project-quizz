<?php
session_start();
include_once 'class/Database.php';
include_once 'class/Question.php';
include_once 'class/Quiz.php';
include_once 'class/Category.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$db = new Database();
$categories = new Category($db);
$categories = $categories->fetchAll();

// Add question
if ($_POST) {
    $questionPost = $_POST['Question'];
    $category = $_POST['category'] ?? null;
    $question = new Question($db, $category);
    if ($category) {
        $questionId = $question->addQuestion($questionPost, $category);
        echo "Question ajoutée avec succès !";

        // Add answer choices for the question
        if (isset($_POST['choix1']) && isset($_POST['choix2']) && isset($_POST['choix3']) && isset($_POST['choix4'])) {
            $choix1 = $_POST['choix1'];
            $choix2 = $_POST['choix2'];
            $choix3 = $_POST['choix3'];
            $choix4 = $_POST['choix4'];

            $question->addResponse($questionId, $choix1, 1); // 1 signifie que c'est la bonne réponse
            $question->addResponse($questionId, $choix2, 0); // 0 signifie que c'est une mauvaise réponse
            $question->addResponse($questionId, $choix3, 0); // 0 signifie que c'est une mauvaise réponse
            $question->addResponse($questionId, $choix4, 0); // 0 signifie que c'est une mauvaise réponse
        } else {
            echo "Veuillez fournir tous les choix.";
        }
    } else {
        echo "Veuillez fournir un choix 1.";
    }
} else {
    echo "Veuillez sélectionner une catégorie.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ajouter une question à Quizz Night - Testez vos connaissances !">
    <title>Quizz Night - Ajouter une question</title>
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
        <h1>Ajouter une question</h1>
    </header>

    <main>
        <form method="post" action="" class="neon-flashing-box">
            <div class="form-group">
                <label for="category">Choisis une catégorie:</label>
                <select name="category" id="category" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Question">Question:</label>
                <textarea name="Question" id="Question" required></textarea>
            </div>
            <div class="form-group">
                <label for="choix1">Choix 1:</label>
                <input type="text" name="choix1" id="choix1" required>
            </div>
            <div class="form-group">
                <label for="choix2">Choix 2:</label>
                <input type="text" name="choix2" id="choix2" required>
            </div>
            <div class="form-group">
                <label for="choix3">Choix 3:</label>
                <input type="text" name="choix3" id="choix3" required>
            </div>
            <div class="form-group">
                <label for="choix4">Choix 4:</label>
                <input type="text" name="choix4" id="choix4" required>
            </div>
            <div class="form-group">
                <button type="submit" class="neon-flashing-box">Ajouter la question</button>
            </div>
        </form>
    </main>
</body>

</html>