<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer des catégories</title>
</head>
<body>
    <h1>Créer des catégories</h1>
    <form action="" method="post">
        <label for="category_name">Nom de la catégorie:</label>
        <input type="text" id="category_name" name="category_name" required>
        <input type="submit" value="Créer">
    </form>
</body>
</html>


<?php

require_once 'class/AddCategories.php';

// class instance i guess
$addCategories = new AddCategories();

// check if form is sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nomCategorie = $_POST['category_name'];
    if ($addCategories->addCategory($nomCategorie)) {
        echo "Catégorie ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la catégorie.";
    }
}

// Aadd a link to creation.php
echo '<a href="creation.php">Retour à la création</a>';

?>