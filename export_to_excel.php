<?php

include 'connect.php';
include 'config.php';

// Vérifier si les dates sont définies
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    // Exécuter la requête SQL
    $stmt = $mysqli->prepare("SELECT * FROM button_clicks WHERE click_date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Récupérer les données
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    $mysqli->close();

    // Définir les en-têtes HTTP pour le téléchargement du fichier CSV
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="data_export.csv"');

    // Ouvrir la sortie en mode écriture
    $output = fopen('php://output', 'w');

    // Ajouter BOM UTF-8 pour éviter les bugs d'encodage dans Excel
    fprintf($output, "\xEF\xBB\xBF");

    // Définir l'en-tête du fichier CSV
    fputcsv($output, ['Type de contact', 'Service', 'Date', 'Nombre de clics'], ';');

    // Ajouter les données
    foreach ($data as $row) {
        fputcsv($output, [
            $row['button_name'],
            $row['service_name'],
            $row['click_date'],
            $row['click_count']
        ], ';');
    }

    // Fermer la sortie
    fclose($output);
    exit;
}

?>
