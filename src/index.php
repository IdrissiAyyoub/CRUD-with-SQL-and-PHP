<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>



    <?php

    $server = 'mysql:host=localhost;dbname=company';
    $username = 'root';
    $password = '';


    // Try to connect to database server
    try {
        $db = new PDO($server, $username, $password);

        $prepareSql = "SELECT * FROM employe inner join srv on employe.IdService = srv.IdService";
        $statement = $db->prepare($prepareSql);

        $statement->execute();

        echo '<table border="1" class="table table-striped">';
        echo "<tr><th>Matricule</th><th>Nom</th><th>Prenom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>Action</th></tr>";

        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
         <td>" . $line['matricule'] . "</td>
         <td>" . $line['nom'] . "</td>
         <td>" . $line['prenom'] . "</td>
         <td>" . $line['dateDeNaissance'] . "</td>
         <td>" . $line['fonction'] . "</td>
         <td>" . $line['salaire'] . "</td>
         <td>" . $line['nomService'] . "</td>
         <td>
           <a href='/login/edit.php?id=" . $line['matricule'] . "'>Edit</a>
           <a href='/login/delete.php?id=" . $line['matricule']  . "'>Delete</a>
         </td>
       </tr>";
        }

        echo "</table>";
        echo '<a href="/login/insert.php" class="btn btn-success">Add New Employee</a>';
    }
    // If there's any error or problem in connecting to database server print error message
    catch (PDOException $error) {
        print $error->getMessage();
    }



    ?>
</body>

</html>