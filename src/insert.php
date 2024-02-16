<?php
$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';


$nom = "";
$prenom = "";
$dateNaissance = "";
$dateEmbauche = "";
$salaire = "";
$fonction = "";
$service = "";







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

        $insertSql = "INSERT INTO employe (nom, prenom, dateDeNaissance, dateEmbauche, salaire, fonction, IdService)
    VALUES (:nom, :prenom, :dateNaissance, :dateEmbauche, :salaire, :fonction, :srv)"; // Removed extra semicolon after :srv

        $insertPrepare = $db->prepare($insertSql);
        $insertPrepare->bindParam(':nom', $nom);
        $insertPrepare->bindParam(':prenom', $prenom);
        $insertPrepare->bindParam(':dateNaissance', $dateNaissance);
        $insertPrepare->bindParam(':dateEmbauche', $dateEmbauche);
        $insertPrepare->bindParam(':salaire', $salaire);
        $insertPrepare->bindParam(':fonction', $fonction);
        $insertPrepare->bindParam(':srv', $service);
        $insertPrepare->execute();
    }
} catch (PDOException $error) {
    echo "Error: " . $error->getMessage();
}
?>

<?php
$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';

try {
    $db = new PDO($server, $username, $password);

    $sqlfonction = "SELECT DISTINCT fonction FROM employe ";
    $fonctionStatments = $db->prepare($sqlfonction);
    $fonctionStatments->execute();
    $fonctions = $fonctionStatments->fetchAll(PDO::FETCH_COLUMN);

    $sqlservice = "SELECT nomService, IdService from srv";
    $servicestatmenst = $db->prepare($sqlservice);
    $servicestatmenst->execute();
    $services = $servicestatmenst->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "error : " . $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Insert New Employee</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Insert New Employee</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="dateNaissance">Date de Naissance:</label>
                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance">
            </div>
            <div class="form-group">
                <label for="dateEmbauche">Date d'Embauche:</label>
                <input type="date" class="form-control" id="dateEmbauche" name="dateEmbauche">
            </div>
            <div class="form-group">
                <label for="salaire">Salaire:</label>
                <input type="number" class="form-control" id="salaire" name="salaire">
            </div>
            <div class="form-group">
                <label for="fonction">Fonction:</label>
                <select class="form-control" id="fonction" name="fonction">
                    <?php foreach ($fonctions as $fonction) { ?>
                        <option value="<?php echo $fonction ?>"><?php echo $fonction; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="service">Service:</label>
                <select class="form-control" id="service" name="srv">
                    <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service['IdService']; ?>"><?php echo $service['nomService']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="TEST.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>

</html>