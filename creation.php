<?php
include_once 'class/database.php';

$database = new Database();
$categories = $database->getCategories();





$question = $_POST['Question'];
$category = $_POST['category'];


$database->addQuestion($question, $category);

echo "Question ajoutée avec succès.";






?>
<form method="post" action="">
    <label for="category">Choose a category:</label>
    <select name="category" id="category">
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="Question">Question:</label>
    <textarea name="Question" id="Question" required></textarea>
    <br>
    
    <br>
    <input type="submit" value="Submit"> 
</form>



