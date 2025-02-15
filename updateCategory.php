<?php
session_start();

include 'class/Database.php';
include 'class/Category.php';

$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = new Category($db);
$categoryData = $category->getCategoryById($categoryId);

if ($_POST) {
    $categoryName = $_POST['category_name'];
    $category->updateCategory($categoryId, $categoryName);
    header('Location: adminPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mettre à jour une catégorie à Quizz Night - Testez vos connaissances !">
    <title>Quizz Night - Mettre à jour une catégorie</title>
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
        <h1>Mettre à jour une catégorie</h1>
    </header>

    <main>
        <form method="post" action="" class="neon-flashing-box">
            <div class="form-group">
                <label for="category_name">Nom de la catégorie:</label>
                <input type="text" name="category_name" id="category_name" value="<?= htmlspecialchars($categoryData['nom']) ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="neon-flashing-box">Mettre à jour la catégorie</button>
            </div>
        </form>
    </main>
</body>

</html>