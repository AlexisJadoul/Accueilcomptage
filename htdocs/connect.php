<?php

include 'config.php';
// Connexion à la base de données
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "compteur_dsi-dev";

 //$mysqli = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli($hostname, $username, $password, $dbname);
// Vérification de la connexion

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else{

            echo '';
        }

?>