<?php
include 'config.php';

// Affiche la date et l'heure actuelles
echo "Date et heure actuelles : " . date("Y-m-d H:i:s") . "<br>";

// Teste avec un changement de date
$date = new DateTime();
echo "Date et heure avec DateTime : " . $date->format('Y-m-d H:i:s');
?>
