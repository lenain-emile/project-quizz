<?php
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
            <!DOCTYPE html>
            <html lang="fr">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Connexion</title>
            </head>

            <body>
                <form action="class/User.php?login=true" method="POST">
                    <div>
                        <label for="username">Nom d'utilisateur:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit">Login</button>
                </form>
            </body>

            </html>
    </div>
    </main>
    </div>


</body>

</html>