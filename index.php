<?php
session_start();
$_SESSION['points'] = 0;
$_SESSION['totalQuestionsAnswered'] = 0;
$_SESSION['currentQuestionIndex'] = 0;

var_dump($_SESSION);
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

                    <li>
                        <a href="#home">Accueil</a>
                    <li><a href="#about">About</a></li>
                    <li><a href="user.php">Profil</a></li>

                    </li>

                    <?php if (!isset($_SESSION['username'])) {
                        echo "<li><a href='login.php'>Connexion</a></li>";
                        echo "<li><a href='register.php'>S'inscrire</a></li>";
                    } else {

                        echo "<li><a href='#'>" . $_SESSION['username'] . "</a></li>";
                        echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    }
                    ?>

                </ul>

        </nav>
        <h1 class="neon-title neon-flashing">Quiz <span>Night</span></h1>

    </header>

    <main>

        <p>Êtes-vous prêt à tester vos connaissances et à relever des défis passionnants ?
            À vous de jouer !</p>
        <div class="container">
            <div class="item">

                <a href="questions.php?id_category=1"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Histoire</h2>
            </div>

            <div class="item">

                <a href="questions.php?id_category=2"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Football</h2>
            </div>
            <div class="item">

                <a href="questions.php?id_category=3"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Géographie</h2>
            </div>
        </div>

        <div class="container">
            <div class="item">

                <a href="questions.php?id_category=4"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Jeux-vidéo</h2>
            </div>
            <div class="item">

                <a href="questions.php?id_category=5"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Musique</h2>
            </div>
            <div class="item">

                <a href="questions.php?id_category=6"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Mangas</h2>
            </div>
        </div>
    </main>
</body>
<?php
?>
</html>
<?php

