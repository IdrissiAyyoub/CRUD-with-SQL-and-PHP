<?php

$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';

try {
    $db = new PDO($server, $username, $password);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['dateNaissance'];
        $dateEmbauche = $_POST['dateEmbauche'];
        $salaire = $_POST['salaire'];
        $fonction = $_POST['fonction'];
        $service = $_POST['srv'];

        $editSql = "UPDATE employe SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateNaissance, dateEmbauche = :dateEmbauche, salaire = :salaire, fonction = :fonction, IdService = :srv WHERE matricule = :id";
        $editprepare = $db->prepare($editSql);
        $editprepare->bindParam(':nom', $nom);
        $editprepare->bindParam(':prenom', $prenom);
        $editprepare->bindParam(':dateNaissance', $dateNaissance);
        $editprepare->bindParam(':dateEmbauche', $dateEmbauche);
        $editprepare->bindParam(':salaire', $salaire);
        $editprepare->bindParam(':fonction', $fonction);
        $editprepare->bindParam(':srv', $service);
        // You also need to bind the ID parameter
        $editprepare->bindParam(':id', $_POST['id']);
        $editprepare->execute();

        header("location: TEST.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
