
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Quizz Night - Jouer et testez vos connaissances">
    <title>Accueil - Quizz Night</title>
    <link rel="stylesheet" href="./index1.css">
    
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <div class="main-container">
        <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
            <div class="user-greeting">
                <div class="logo">
                    <img src="https://img.freepik.com/photos-premium/question-symbole-caractere-neon-isole-reflexion-illustration-rendu-3d-illustration-3d_14117-687.jpg" alt="Cool Quizz Night Logo" width="200" height="100">
                                    </div>  <h2>Bonjour <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h2>  <div class="button-group">
                    <a href="index.php" class="btn">Accueil</a>
                    <a href="deconnexion.php" class="btn">Déconnexion</a>
                </div>
            </div>
        <?php else: ?>
            <main class="login-container">
                <h1>Quizz Night</h1>
                <div class="logo">
                   
                    <img src="https://img.freepik.com/photos-premium/question-symbole-caractere-neon-isole-reflexion-illustration-rendu-3d-illustration-3d_14117-687.jpg" alt="Quizz Night Logo" width="200" height="100">
                </div>
                
                <form action="login.php" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Entrez votre nom d'utilisateur" 
                            required 
                            autocomplete="username"
                            minlength="3"
                            maxlength="50"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Entrez votre mot de passe" 
                            required 
                            autocomplete="current-password"
                            minlength="8"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Connexion</button>
                </form>

                <div class="button-group">
                    <a href="inscription.php" class="btn btn-secondary">S'inscrire</a>
                    <a href="mot-de-passe-oublie.php" class="btn btn-link">Mot de passe oublié ?</a>
                </div>
            </main>
        <?php endif; ?>
    </div>
</body>
</html>