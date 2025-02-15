<?php
session_start();
include 'class/Database.php';
include 'class/Question.php';
include 'class/Category.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$question = new Question($db, null);
$questions = $question->fetchAll();

$category = new Category($db);
$categories = $category->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Page - Quizz Night">
    <title>Page d'administration</title>
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
        <h1>Page d'administration</h1>
    </header>

    <main>
        <div class="container">
            <a href="addQuestion.php">Ajouter une question</a>
            <a href="addCategory.php">Ajouter une catégorie</a>
        </div>
        <h2>Questions</h2>
        <table class="neon-flashing-box">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Catégorie</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?= $question['id'] ?></td>
                        <td><?= htmlspecialchars($question['question_text']) ?></td>
                        <td><?= htmlspecialchars($question['category_name']) ?></td>
                        <td><a href="updateQuestion.php?id=<?= $question['id'] ?>">Modifier</a></td>
                        <td><a href="deleteQuestion.php?id=<?= $question['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette question?')">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Catégories</h2>
        <table class="neon-flashing-box">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= htmlspecialchars($category['nom']) ?></td>
                        <td><a href="updateCategory.php?id=<?= $category['id'] ?>">Modifier</a></td>
                        <td><a href="deleteCategory.php?id=<?= $category['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie?')">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>