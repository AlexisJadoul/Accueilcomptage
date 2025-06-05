<?php
include 'connect.php';
include 'config.php';

// Get today's date
$today = date('Y-m-d');

// Prepare query to sum click counts by hour for today
$stmt = $mysqli->prepare(
    "SELECT HOUR(click_date) AS hour, SUM(click_count) AS total " .
    "FROM button_clicks WHERE DATE(click_date) = ? GROUP BY HOUR(click_date) ORDER BY hour"
);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

$stats = [];
while ($row = $result->fetch_assoc()) {
    $stats[(int)$row['hour']] = (int)$row['total'];
}

$stmt->close();
$mysqli->close();

header('Content-Type: application/json');
echo json_encode($stats);
?>
