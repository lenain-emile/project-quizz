<?php
require_once 'classes/database.php';
require_once 'classes/RemoveCategory.php';
require_once 'classes/ModifyCategory.php';

class GetCategory extends Database {
    public function getCategories() {
        $query = 'SELECT id, nom FROM categories'; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$category = new GetCategory();
$categories = $category->getCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_id'])) {
        $removeCategory = new RemoveCategory();
        $removeCategory->deleteCategory($_POST['category_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['update_category_id']) && isset($_POST['new_name'])) {
        $updateCategory = new UpdateCategory();
        $updateCategory->updateCategoryName($_POST['update_category_id'], $_POST['new_name']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
    <form method="POST" action="">
        <select name="category_id">
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                    <?php echo htmlspecialchars($cat['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Supprimer</button>
    </form>

    <form method="POST" action="">
        <select name="update_category_id">
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                    <?php echo htmlspecialchars($cat['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="new_name" placeholder="Nouveau nom">
        <button type="submit">Modifier</button>
    </form>
</body>
</html>