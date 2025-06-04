<?php
// Connexion à la base de données
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "compteur_dsi-dev";

$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Définition des noms de service
$services = array(
    "PoleEmploi"    => "France Travail",
    "Environnement" => "Environnement",
    "RdvRa"         => "RDV RA",
    "Interne"       => "Interne",
    "MissionLocale" => "Mission Locale",
    "LeClic"        => "Le Clic",
    "Autres"        => "Autres"
);

// Récupérer la date du jour au format AAAA-MM-JJ
$today = date('Y-m-d');

// Initialize counters array for both physical and telephone
$counters = array();

// Get counters for each service
foreach ($services as $key => $value) {
    // Requête pour récupérer le compteur physique pour ce service à la date du jour
    $stmt = $mysqli->prepare("SELECT SUM(click_count) as total FROM button_clicks WHERE service_name = ? AND click_date = ? AND button_name = 'Physique'");
    $stmt->bind_param("ss", $key, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Store the physical count in our array
    $counters[$key] = $row['total'] ? intval($row['total']) : 0;
    
    $stmt->close();

    // Requête pour récupérer le compteur téléphone pour ce service à la date du jour
    $stmt = $mysqli->prepare("SELECT SUM(click_count) as total FROM button_clicks WHERE service_name = ? AND click_date = ? AND button_name = 'Téléphone'");
    $stmt->bind_param("ss", $key, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Store the telephone count with 'T' suffix
    $counters[$key . 'T'] = $row['total'] ? intval($row['total']) : 0;
    
    $stmt->close();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($counters);

// Fermeture de la connexion à la base de données
$mysqli->close();
?>
