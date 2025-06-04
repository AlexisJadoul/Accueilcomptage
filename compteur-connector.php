<?php

include 'config.php';

header('Cache-Control: max-age=86400');
header("Expires: Tue, 01 Jan 2035 00:00:00 GMT");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jsonData = json_decode(file_get_contents('php://input'), true);

    if (isset($jsonData['button']) && isset($jsonData['service'])) {
        $buttonName = htmlspecialchars($jsonData['button']);
        $serviceName = htmlspecialchars($jsonData['service']);

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compteur_dsi-dev";

        $mysqli = new mysqli($hostname, $username, $password, $dbname);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } else {
            echo '';
        }

        $currentDate = date("Y-m-d");

        $stmt = $mysqli->prepare("SELECT * FROM button_clicks WHERE button_name = ? AND service_name = ? AND click_date = ?");
        $stmt->bind_param("sss", $buttonName, $serviceName, $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $clickCount = $row['click_count'];
            if ($jsonData['inputValue'] > 0) {
                $clickCount += $jsonData['inputValue'];
                $stmt = $mysqli->prepare("UPDATE button_clicks SET click_count = ? WHERE button_name = ? AND service_name = ? AND click_date = ?");
                $stmt->bind_param("isss", $clickCount, $buttonName, $serviceName, $currentDate);
            } else {
                $clickCount++;
                $stmt = $mysqli->prepare("UPDATE button_clicks SET click_count = ? WHERE button_name = ? AND service_name = ? AND click_date = ?");
                $stmt->bind_param("isss", $clickCount, $buttonName, $serviceName, $currentDate);
            }
      } else {
            $clickCount = ($jsonData['inputValue'] > 0) ? $jsonData['inputValue'] : 1;
            $stmt = $mysqli->prepare("INSERT INTO button_clicks (button_name, service_name, click_date, click_count) VALUES (?, ?, ?, ?)");␊
            $stmt->bind_param("sssi", $buttonName, $serviceName, $currentDate, $clickCount);␊
        }

        if ($stmt->execute()) {
            echo "Button click recorded successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "Button data is missing";
    }
} else {
    echo "Invalid request method";
}

?>
