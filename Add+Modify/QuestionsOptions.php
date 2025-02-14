<?php
require_once 'classes/database.php';
require_once 'classes/RemoveQuestions.php';
require_once 'classes/ModifyQuestions.php';
class Getquestions extends Database {
    public function getquestions() {
        $query = 'SELECT id, categorie_id, question_text FROM questions'; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$category = new Getquestions();
$categories = $category->getquestions();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_id'])) {
        $removequestions = new RemoveQuestions();
        $removequestions->deletequestions($_POST['category_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['update_category_id']) && isset($_POST['new_name'])) {
        $updatequestions = new UpdateQuestion();
        if ($updatequestions->renameQuestion($_POST['update_category_id'], $_POST['new_name'])) {
            echo "La question a été renommée avec succès.";
        } else {
            echo "Une erreur s'est produite lors du renommage de la question.";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Questions</title>
</head>
<body>
    <form method="POST" action="">
        <select name="category_id">
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                    <?php echo htmlspecialchars($cat['question_text']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Supprimer</button>
    </form>

    <form method="POST" action="">
        <select name="update_category_id">
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                    <?php echo htmlspecialchars($cat['question_text']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="new_name" placeholder="Nouveau nom">
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
