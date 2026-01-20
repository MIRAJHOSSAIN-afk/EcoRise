<?php
include 'config.php';

$sql = "UPDATE campaigns SET image_url = 'assets/campaigns/image68c5fbf568e450.01890503.png' WHERE id = 5";

if ($conn->query($sql) === TRUE) {
    echo "Database updated successfully - Campaign image extension corrected to .png";
} else {
    echo "Error updating database: " . $conn->error;
}

$conn->close();
?>
//image updated.php