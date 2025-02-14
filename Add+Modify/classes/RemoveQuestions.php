<?php
require_once 'database.php';

class RemoveQuestions extends Database {
    public function deletequestions($id) {
        $query = 'DELETE FROM questions WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>