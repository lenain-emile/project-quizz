<?php
require_once 'database.php';

class UpdateCategory extends Database {
    public function updateCategoryName($categoryId, $newName) {
        $query = 'UPDATE categories SET nom = :newName WHERE id = :categoryId';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }


}
?>






