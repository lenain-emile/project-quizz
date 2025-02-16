<?php
class Database
{
    private $host    = 'localhost';
    private $name    = 'quiz';
    private $user    = 'root';
    private $pass    = '';
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
        }
        try {
            $this->connexion = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->name,
                $this->user,
                $this->pass,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                )
            );
        } catch (PDOException $e) {
            echo 'Erreur : Impossible de se connecter à la BDD !';
            die();
        }
    }

    public function query($sql, $data = array())
    {
        $statement = $this->connexion->prepare($sql);
        $statement->execute($data);
        return $statement;
    }
    public function insert($sql, $data = array())
    {

        $statement = $this->connexion->prepare($sql);
        $statement->execute($data);
    }

    public function lastInsertId()
    {
        return $this->connexion->lastInsertId();
    }
}
$db = new Database();

/*
    $pdo = new PDO('mysql:host=localhost;dbname=user_management', 'root', '',);

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $request = $pdo->prepare("SELECT * FROM user_management WHERE username = :username");
    $request->execute(['username' => $username]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    
    if ($password == $result['password']) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    }
}
?><?php
session_start();
require_
$pdo = new PDO('mysql:host=localhost;dbname=user_management', 'root', '',);

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $request = $pdo->prepare("SELECT * FROM user_management WHERE username = :username");
    $request->execute(['username' => $username]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    
    if ($password == $result['password']) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    }

    
*/
