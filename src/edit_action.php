<?php

$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';

try {
    $db = new PDO($server, $username, $password);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
 

        $editSql = "UPDATE employe SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateNaissance, dateEmbauche = :dateEmbauche, salaire = :salaire, fonction = :fonction, IdService = :srv WHERE matricule = :id";
        $editprepare = $db->prepare($editSql);
        $editprepare->bindParam(':nom', $_POST['nom']);
        $editprepare->bindParam(':prenom', $_POST['prenom']);
        $editprepare->bindParam(':dateNaissance', $_POST['dateNaissance']);
        $editprepare->bindParam(':dateEmbauche', $_POST['dateEmbauche']);
        $editprepare->bindParam(':salaire', $_POST['salaire']);
        $editprepare->bindParam(':fonction', $_POST['fonction']);
        $editprepare->bindParam(':srv', $_POST['srv']);
        $editprepare->bindParam(':id', $_POST['id']);
        $editprepare->execute();
    }
    header("location: index.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
