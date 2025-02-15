<?php

class Category
{
    private $db;
    private $id;
    private $name;

    public function __construct($db, $id = null)
    {
        $this->db = $db;
        $this->id = $id;
    }


    public function fetchAll()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name)
    {
        $sql = "INSERT INTO categories (nom) VALUES (:name)";
        $this->db->insert($sql, ['name' => $name]);
    }

    public function updateCategory($id, $newName)
    {
        $sql = "UPDATE categories SET nom = :name WHERE id = :id";
        $this->db->query($sql, ['name' => $newName, 'id' => $id]);
    }


    public function deleteCategory($id)
    {
        // Fetch all questions related to the category
        $sql = "SELECT id FROM questions WHERE categorie_id = :id";
        $questions = $this->db->query($sql, ['id' => $id])->fetchAll(PDO::FETCH_ASSOC);

        // Delete all answers related to those questions
        foreach ($questions as $question) {
            $sql = "DELETE FROM reponses WHERE question_id = :question_id";
            $this->db->query($sql, ['question_id' => $question['id']]);
        }

        // Delete all questions related to the category
        $sql = "DELETE FROM questions WHERE categorie_id = :id";
        $this->db->query($sql, ['id' => $id]);

        // Delete the category itself
        $sql = "DELETE FROM categories WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }
}
