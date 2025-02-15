<?php
session_start();
include 'class/Database.php';
include 'class/Category.php';

$category = new Category($db);

if ($_POST) {
    $categoryName = $_POST['category_name'];
    $category->addCategory($categoryName);
    echo "Catégorie ajoutée avec succès !";
    header('Location: adminPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ajouter une catégorie à Quizz Night - Testez vos connaissances !">
    <title>Quizz Night - Ajouter une catégorie</title>
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
        <h1>Ajouter une catégorie</h1>
    </header>

    <main>
        <form method="post" action="" class="neon-flashing-box">
            <div class="form-group">
                <label for="category_name">Nom de la catégorie:</label>
                <input type="text" name="category_name" id="category_name" required>
            </div>
            <div class="form-group">
                <button type="submit" class="neon-flashing-box">Ajouter la catégorie</button>
            </div>
        </form>
    </main>
</body>

</html>