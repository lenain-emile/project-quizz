<?php
session_start();

include 'class/Database.php';
include 'class/Category.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = new Category($db);

if ($categoryId) {
    $category->deleteCategory($categoryId);
    echo "Catégorie supprimée avec succès !";
    header('Location: adminPage.php');
    exit;
}
