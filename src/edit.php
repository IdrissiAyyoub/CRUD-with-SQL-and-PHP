<?php
$server = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';

try {
    $db = new PDO($server, $username, $password);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $prepareSql = "SELECT * FROM employe WHERE matricule = :id";
        $statement = $db->prepare($prepareSql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $employe = $statement->fetch(PDO::FETCH_ASSOC);


        $sqlfonction = "SELECT DISTINCT fonction FROM employe ";
        $fonctionStatments = $db->prepare($sqlfonction);
        $fonctionStatments->execute();
        $fonctions = $fonctionStatments->fetchAll(PDO::FETCH_COLUMN);

        $sqlservice = "SELECT nomService, IdService from srv";
        $servicestatmenst = $db->prepare($sqlservice);
        $servicestatmenst->execute();
        $services = $servicestatmenst->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $error) {
    print $error->getMessage();
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
        <form action="edit_action.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="hidden" name="matricule" value="<?php echo $employe['matricule']; ?>">

                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $employe['nom'] ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $employe['prenom'] ?>">
            </div>
            <div class=" form-group">
                <label for="dateNaissance">Date de Naissance:</label>
                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="<?php echo $employe['dateDeNaissance'] ?>">
            </div>
            <div class=" form-group">
                <label for="dateEmbauche">Date d'Embauche:</label>
                <input type="date" class="form-control" id="dateEmbauche" name="dateEmbauche" value="<?php echo $employe['dateEmbauche'] ?>">
            </div>
            <div class=" form-group">
                <label for="salaire">Salaire:</label>
                <input type="number" class="form-control" id="salaire" name="salaire" value="<?php echo $employe['salaire'] ?>">
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