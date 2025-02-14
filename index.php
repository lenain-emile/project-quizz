<?php
session_start();
$_SESSION['points'] = 0;
$_SESSION['totalQuestionsAnswered'] = 0;
$_SESSION['currentQuestionIndex'] = 0;

include 'class/Database.php';
include 'class/Category.php';

$db = new Database();
$category = new Category($db);
$categories = $category->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Night Quiz </title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
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
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <li><a href="login.php">Connexion</a></li>
                        <li><a href="register.php">S'inscrire</a></li>
                    <?php } else { ?>
                        <li><a href="#"><?= $_SESSION['username'] ?></a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <h1 class="neon-title neon-flashing">Quiz <span>Night</span></h1>
    </header>

    <main>
        <p>Êtes-vous prêt à tester vos connaissances et à relever des défis passionnants ? À vous de jouer !</p>
            <?php 
            $counter = 0;
            foreach ($categories as $category) { 
                if ($counter % 3 == 0) {
                    if ($counter > 0) {
                        echo '</div>'; 
                    }
                    echo '<div class="container">';
                }
                ?>
                <div class="item">
                    <a href="questions.php?id_category=<?= $category['id'] ?>"><img src="image/quizz.png" alt="Description of image"></a>
                    <h2><?= htmlspecialchars($category['nom']) ?></h2>
                </div>
                <?php 
                $counter++;
            } 
            if ($counter > 0) {
                echo '</div>';
            }
            ?>
    </main>
</body>
</html>