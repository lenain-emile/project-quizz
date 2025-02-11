<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Night Quiz </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Corinthia:wght@400;700&family=League+Script&display=swap" rel="stylesheet">


</head>

<body>
    <nav class="navbar mobile">
        <div class="navbar-container">
            <input type="checkbox" id="navbar-toggle">
            <label for="navbar-toggle" class="navbar-icon">&#9776;</label>
            <div class="navbar-menu">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="user.php">Profil</a>
            </div>
        </div>
    </nav>

    <nav class="navbar desktop">
        <div class="navbar-container">
            <input type="checkbox" id="navbar-toggle">
            <ul class="navbar-menu">
                <li><a href="#home">Accueil</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="user.php">Profil</a></li>
            </ul>

        </div>
        </div>
    </nav>
    <main>
        <h1 class="neon-title">Quiz <span>Night</span></h1>

        <p>Êtes-vous prêt à tester vos connaissances et à relever des défis passionnants ?
            À vous de jouer !</p>
        <div class="container">
            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Manga</h2>
            </div>

            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Football</h2>
            </div>
            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Serie TV</h2>
            </div>
        </div>

        <div class="container">
            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Titre 4</h2>
            </div>
            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Titre 5</h2>
            </div>
            <div class="item">

                <a href="#"><img src="image/quizz.png" alt="Description of image"></a>
                <h2>Titre 6</h2>
            </div>
        </div>
    </main>
</body>

</html>