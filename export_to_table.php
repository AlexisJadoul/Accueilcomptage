<?php


include 'connect.php';
include 'config.php';


// Traitement du formulaire de plage de dates
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    // Préparer et exécuter la requête SQL pour obtenir les données dans la plage de dates choisie
    $stmt = $mysqli->prepare("SELECT * FROM button_clicks WHERE click_date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fermer la connexion à la base de données
$mysqli->close();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportation de données</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<meta name="theme-color" content="#7952b3">  
</head>
<body class="py-4">

 <div class="container">
    <h1>Résultats</h1><p>Du <? echo "$startDate" ?> au <? echo "$endDate" ?>  </p>


    <!-- Afficher les données dans un tableau HTML -->
    <?php if (isset($data)) : ?>
       
        <table class="table table-striped table-bordered" border="1">
            <tr>
                <th>Type de contact</th>
                <th>Service</th>
                <th>Date</th>
                <th>Nombre de clics</th>
                <!-- ... Ajoutez d'\autres en-têtes de colonnes selon votre table ... -->
            </tr>
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= $row['button_name']; ?></td>
                    <td><?= $row['service_name']; ?></td>
                    <td><?= $row['click_date']; ?></td>
                    <td><?= $row['click_count']; ?></td>
                    <!-- ... Affichez d'autres colonnes selon votre table ... -->
                </tr>
            <?php endforeach; ?>
        </table>
         <!-- Bouton HTML pour exporter vers Excel -->
        <button type="button" class="btn-excel btn btn-primary"><a href="export_to_excel.php?start_date=<?= $startDate ?>&end_date=<?= $endDate ?>" target="_blank" style="color: #fff;">Exporter vers Excel</a></button>
      <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    <?php endif; ?>


 <!-- Afficher le formulaire 
    <h2>Choisir une autre plage horaire :</h2>
    <form action="" method="get">
        <label for="start_date">Date de début :</label>
        <input type="date" id="start_date" name="start_date" required>
        <label for="end_date">Date de fin :</label>
        <input type="date" id="end_date" name="end_date" required>
        <input type="submit" value="Afficher les données">
    </form>-->
 </div>
</body>
</html>


