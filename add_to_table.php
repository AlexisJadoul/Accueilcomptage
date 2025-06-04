<?php

include 'config.php';


//include 'connect.php';
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "compteur_dsi";

// Connexion à la base de données
$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}
/*else {

    echo "connecté";

}*/

// Récupérer les données du formulaire

if (isset($_POST["date"]) && isset($_POST['clickCount']) && isset($_POST['buttonName']) && isset($_POST['serviceName'])) {

$date = $_POST["date"];
$clickCount = $_POST["clickCount"];
$buttonName = $_POST["buttonName"];
$serviceName = $_POST["serviceName"];


//$date = date("Y-m-d");
       //$currentDate = date("d-m-Y");

        // Check if there's a record for the button and service on the current date
        $stmt = $mysqli->prepare("SELECT * FROM button_clicks WHERE button_name = ? AND service_name = ? AND click_date = ?");
        $stmt->bind_param("sss", $buttonName, $serviceName, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

       if ($row) {
            // Si l'enregistrement existe, update du click count
            $clickCount = $row['click_count'] + $clickCount;
            $stmt = $mysqli->prepare("UPDATE button_clicks SET click_count = ? WHERE button_name = ? AND service_name = ? AND click_date = ?");
            $stmt->bind_param("isss", $clickCount, $buttonName, $serviceName, $date);
        } else {
            // Si l'enregistrement n'existe pas, on insère un nouvel enregistrement
            //$clickCount = 1;
            $stmt = $mysqli->prepare("INSERT INTO button_clicks (button_name, service_name, click_date, click_count) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $buttonName, $serviceName, $date, $clickCount);
        }

        if ($stmt->execute()) {
            echo "Button click recorded successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Fermeture de la connection a la BDD
        $stmt->close();
        $mysqli->close();
    } else {
        echo "Button data is missing";
    }
    /*
} else {
    echo "Invalid request method";
}

*/





/*
// Préparer la requête SQL de mise à jour
$sql = "UPDATE button_clicks SET click_count=?, button_name=?, service_name=? WHERE click_date=?";

// Préparer la déclaration SQL et lier les paramètres
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("sss",  $clickCount, $buttonName, $serviceName, $date);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Données mises à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des données : " . $stmt->error;
    }

    // Fermer la déclaration
    $stmt->close();
} else {
    echo "Erreur de préparation de la requête : " . $mysqli->error;
}

// Fermer la connexion à la base de données
$mysqli->close();



*/

/*

 $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compteur_dsi";


// Récupérer les données passées via la méthode GET
if (isset($_GET["date"]) && isset($_GET["clickCount"]) && isset($_GET["buttonName"]) && isset($_GET["serviceName"])) {

    $date = $_GET["date"];
    $clickCount = $_GET["clickCount"];
    $buttonName = $_GET["buttonName"];
    $serviceName = $_GET["serviceName"];


       
        
   /// Créer une nouvelle instance MySQLi
    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Connexion échouée : " . $mysqli->connect_error);
    }
     $date = date("Y-m-d");
     //$clickCount = clickCount + ?;
    // Préparer et exécuter la requête SQL pour mettre à jour les données dans la base de données
    //$stmt = $mysqli->prepare("UPDATE button_clicks SET button_name = ?, service_name = ?, click_count = ? WHERE click_date = ?");*/
    //$stmt = $mysqli->prepare("INSERT INTO button_clicks (button_name, service_name, click_date, click_count) VALUES (?, ?, ?, ?)");
    /*$stmt = $mysqli->prepare("UPDATE button_clicks SET click_count = clickCount + ? WHERE button_name = ? AND service_name = ? AND click_date = ?");
    //$stmt->bind_param("isssiiii", $clickCount, $buttonName, $serviceName, $date);
   $stmt = $mysqli->prepare("INSERT INTO button_clicks (buttonName, serviceName, click_count) VALUES ($buttonName, $serviceName, $click_count) WHERE click_date = $date");
    $stmt->bind_param("iss", $type, $service, $nbClicks, $date);
    $stmt->execute();
    $stmt->close();

    
    echo "Mise à jour effectuée avec succès.";
} else {
    echo "Veuillez fournir toutes les données nécessaires.";
}

// Fermer la connexion à la base de données
    $mysqli->close();
*/
?>