<?php
include 'config.php';

header('Content-Type: application/json');

$sql = "SELECT id, title, goal, target_amount, raised_amount, image_url FROM campaigns";
$result = $conn->query($sql);

$campaigns = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $campaigns[] = $row;
    }
}

echo json_encode($campaigns);

$conn->close();
?>
