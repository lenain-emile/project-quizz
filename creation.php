<?php
include_once 'class/database.php';

$database = new Database();
$categories = $database->getCategories();

// Add question
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['Question'];
    $category = isset($_POST['category']) ? $_POST['category'] : null;

    if ($category) {
        $questionId = $database->addQuestion($question, $category);
        echo "Question ajoutée avec succès !";

        // Add aswer for Ze question
        if (isset($_POST['choix1']) && isset($_POST['choix2']) && isset($_POST['choix3']) && isset($_POST['choix4'])) {
            $choix1 = $_POST['choix1'];
            $choix2 = $_POST['choix2'];
            $choix3 = $_POST['choix3'];
            $choix4 = $_POST['choix4'];

            $database->addResponse($questionId, $choix1, 1); // 1 signifie que c'est la bonne réponse
            $database->addResponse($questionId, $choix2, 0); // 0 signifie que c'est une mauvaise réponse
            $database->addResponse($questionId, $choix3, 0); // 0 signifie que c'est une mauvaise réponse
            $database->addResponse($questionId, $choix4, 0); // 0 signifie que c'est une mauvaise réponse
        } else {
            echo "Veuillez fournir tous les choix.";
        }
        } else {
            echo "Veuillez fournir un choix 1.";
        }
    } else {
        echo "Veuillez sélectionner une catégorie.";
    }

?>

<form method="post" action="">
    <label for="category">Choisis une:</label>
    <select name="category" id="category" required>
        <option value="">Sélectionnez une catégorie</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="Question">Question:</label>
    <textarea name="Question" id="Question" required></textarea>
    <br>
    <label for="choix1">Choix 1:</label>
    <input type="text" name="choix1" id="choix1" required>
    <br>
    <label for="choix2">Choix 2:</label>
    <input type="text" name="choix2" id="choix2" required>
    <br>
    <label for="choix3">Choix 3:</label>
    <input type="text" name="choix3" id="choix3" required>
    <br>
    <label for="choix4">Choix 4:</label>
    <input type="text" name="choix4" id="choix4" required>
    <br>
    <input type="submit" value="Submit">
</form>



