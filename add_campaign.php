<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title']; 
    $goal = $_POST['goal'];
    $target_amount = $_POST['target_amount'];
    $location = $_POST['location'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
        echo '<div class="message-box error">Invalid title format.</div>';
    }
    if ($target_amount < 0) {
        echo '<div class="message-box error">Target amount cannot be a negative number.</div>';
    }

    else{
    
        $check_sql = "SELECT COUNT(*) FROM campaigns WHERE title = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $title);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            echo '<div class="message-box error">Campaign is already exists.</div>';
        } else {
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                
                $image = $_FILES['image'];
                $image_name = uniqid('image', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
                $image_tmp_name = $image['tmp_name'];
                $image_size = $image['size'];
                
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                
                if (in_array($image_ext, $allowed_types)) {
                   
                    if ($image_size <= 5000000) { // 5MB
                        
                        $upload_dir = 'assets/campaigns'; 
                        
                        
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        
                        
                        if (move_uploaded_file($image_tmp_name, $upload_dir . $image_name)) {
                           
                            $image_url = $upload_dir . $image_name; 
                           
                            $sql = "INSERT INTO campaigns (title, goal, target_amount, location, image_url, created_at) 
                                    VALUES (?, ?, ?, ?, ?, NOW())";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ssdss", $title, $goal, $target_amount, $location, $image_url);

                            
                            if ($stmt->execute()) {
                                echo '<div class="message-box success">Campaign added successfully!</div>';
                            } else {
                                echo '<div class="message-box error">Error: ' . htmlspecialchars($stmt->error) . '</div>';
                            }

                            $stmt->close();
                        } else {
                            echo '<div class="message-box error">Failed to upload image.</div>';
                        }
                    } else {
                        echo '<div class="message-box error">Image size exceeds the limit of 5MB.</div>';
                    }
                } else {
                    echo '<div class="message-box error">Invalid image type. Only JPG, JPEG, PNG, and GIF files are allowed.</div>';
                }
            } else {
                echo '<div class="message-box error">No image uploaded or an error occurred during upload.</div>';
            }
        }
    }
   
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Campaign</title>
    <link rel="stylesheet" href="assets/css/add_campaign.css"> 
</head>
<body>
    <h1>Add New Campaign</h1>
    <form action="add_campaign.php" method="POST" enctype="multipart/form-data">
        <label for="title">Campaign Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="goal">Goal:</label>
        <input type="text" name="goal" id="goal" required><br><br>

        <label for="target_amount">Target Amount:</label>
        <input type="number" name="target_amount" id="target_amount" required><br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required><br><br>

        <label for="image">Campaign Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>

        <button type="submit">Add Campaign</button>
    </form>
</body>
</html>
