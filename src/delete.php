<?php


$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';

try {
    $db = new PDO($server, $username, $password);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $prepareSql = "DELETE FROM employe WHERE matricule = :id";
        $statement = $db->prepare($prepareSql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        header('location: /login/index.php');
        exit();
    }
} catch (PDOException $e) {
    print $e->getMessage();
}
