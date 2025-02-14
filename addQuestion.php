<?php
include_once 'class/Database.php';
include_once 'class/Question.php';
include_once 'class/Quiz.php';
include_once 'class/Category.php';


$db = new Database();
$categories = new Category($db);
$categories = $categories->fetchAll();




// Add question
if ($_POST) {
    $questionPost = $_POST['Question'];
    $category = $_POST['category'] ?? null;
    $question = new Question($db, $category);
    if ($category) {
        $questionId = $question->addQuestion($questionPost, $category);
        echo "Question ajoutée avec succès !";

        // Add answer choices for the question
        if (isset($_POST['choix1']) && isset($_POST['choix2']) && isset($_POST['choix3']) && isset($_POST['choix4'])) {
            $choix1 = $_POST['choix1'];
            $choix2 = $_POST['choix2'];
            $choix3 = $_POST['choix3'];
            $choix4 = $_POST['choix4'];

            $question->addResponse($questionId, $choix1, 1); // 1 signifie que c'est la bonne réponse
            $question->addResponse($questionId, $choix2, 0); // 0 signifie que c'est une mauvaise réponse
            $question->addResponse($questionId, $choix3, 0); // 0 signifie que c'est une mauvaise réponse
            $question->addResponse($questionId, $choix4, 0); // 0 signifie que c'est une mauvaise réponse
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
    <br>
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