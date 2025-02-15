<?php
include 'class/Database.php';
include 'class/Category.php';

$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = new Category($db);

if ($categoryId) {
    $category->deleteCategory($categoryId);
    echo "Catégorie supprimée avec succès !";
    header('Location: adminPage.php');
    exit;
}
?>