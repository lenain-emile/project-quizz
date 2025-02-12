<?php
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connexion à Quizz Night - Testez vos connaissances !">
    <title>Quizz Night - Connexion</title>
    <link rel="stylesheet" href="./connexion.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Bienvenue sur Quizz Night</h1>
        </header>

        <main>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="login-form">
                    <div class="input-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Entrez votre nom d'utilisateur"
                            required 
                            autocomplete="username"
                            maxlength="50"
                        >
                    </div>

                    <div class="input-group">
                        <label for="password">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Entrez votre mot de passe"
                            required 
                            autocomplete="current-password"
                        >
                    </div>

                    <button type="submit" class="btn-login neon-button">Se connecter</button>

                    <div class="form-links">
                        <a href="inscription.php" class="neon-link">Créer un compte</a>
                        <a href="mot-de-passe-oublie.php" class="neon-link">Mot de passe oublié ?</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    
</body>
</html>