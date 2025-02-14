<?php
require_once 'database.php';

class RemoveCategory extends Database {
    public function deleteCategory($id) {
        $query = 'DELETE FROM categories WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>