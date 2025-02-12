<?php
session_start();
require_once 'config.php';

class User {
    protected function login($username, $password) {
        $stmt = $this->p
        do->prepare("SELECT * FROM user_management WHERE username = :username");
        $request->execute(['username' => $username]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
            header('Location: index.php');
            exit;
        }
    }
?>

