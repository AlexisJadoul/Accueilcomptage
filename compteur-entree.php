<?php
/*
include 'connect.php';
include 'config.php';

// On vérifie si méthod = POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data from the request body and decode it
    $data = json_decode(file_get_contents('php://input'), true);

    // On vérifie sir les datas sont présentes
     //if (!empty($data->numero)) {
      if (isset($jsonData['button']) && isset($jsonData['service']) && isset($jsonData['numero'])) {
        // Sanitize and store the button name and service name

        $buttonName = htmlspecialchars($jsonData['button']);
        $serviceName = htmlspecialchars($jsonData['service']);
        $numero = htmlspecialchars($jsonData['numero']);

       /*
        // Database connection parameters
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compteur_dsi";

        // Nouvelle instance MYSQLi
        $mysqli = new mysqli($hostname, $username, $password, $dbname);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }else{

            echo 'ok';
        }
    }

}   
       /*  

        // Date au format YYYY-MM-DD format
       $currentDate = date("Y-m-d");
       //$currentDate = date("d-m-Y");

        // Check if there's a record for the button and service on the current date
        $stmt = $mysqli->prepare("SELECT * FROM button_clicks WHERE button_name = ? AND service_name = ? AND click_date = ?");
        $stmt->bind_param("sss", $buttonName, $serviceName, $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

       if ($numero) {
            // Si l'enregistrement existe, update du click count
            $clickCount = $row['click_count'] + ?;
            $stmt = $mysqli->prepare("UPDATE button_clicks SET click_count = ? WHERE button_name = ? AND service_name = ? AND click_date = ?");
            $stmt->bind_param("isss", $clickCount, $buttonName, $serviceName, $currentDate);
        } else {
            // Si l'enregistrement n'existe pas, on insère un nouvel enregistrement
            $clickCount = 1;
            $stmt = $mysqli->prepare("INSERT INTO button_clicks (button_name, service_name, click_date, click_count) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $buttonName, $serviceName, $currentDate, $clickCount);
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

    }
} else {
    echo "Invalid request method";
}


*/
?>
