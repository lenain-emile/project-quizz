<?php
include 'Database.php';

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE user_name = :username";
        $result = $this->db->query($sql, ['username' => $username])->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['user_password'])) {
            $_SESSION['username'] = $username;
            header('Location: ../index.php');
            exit;
        } else {
            var_dump($sql);
            echo 'Invalid username or password';
        }
    }

    public function register($username, $password) {
        $sql = "INSERT INTO users (user_name, user_password) VALUES (:username, :password)";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->db->insert($sql, ['username' => $username, 'password' => $password]);
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
        exit;
    }
    
}
$user = new User($db);
/* We check if the submitted form is a Login or Register form, then call the corresponding method */

if ($_POST && isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user->login($username, $password);
}

if ($_POST && isset($_GET['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user->register($username, $password);
}
