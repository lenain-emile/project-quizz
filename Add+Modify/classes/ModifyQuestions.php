<?php
require_once 'database.php';

class UpdateQuestion extends Database {
    public function renameQuestion($id, $newText) {
        $query = 'UPDATE questions SET question_text = :newText WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':newText', $newText);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>