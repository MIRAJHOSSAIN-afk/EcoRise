<?php
session_start(); 


session_regenerate_id(true);


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit; 
}


include 'config.php';


if (isset($_POST['campaign_id'], $_POST['amount']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
    $campaign_id = $_POST['campaign_id']; 
    $amount = $_POST['amount']; 

  
    $sql = "INSERT INTO support (user_id, campaign_id, amount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("iid", $user_id, $campaign_id, $amount);

    
    if ($stmt->execute()) {
    
        $sql_fetch = "SELECT raised_amount FROM campaigns WHERE id = ?";
        $stmt_fetch = $conn->prepare($sql_fetch);
        $stmt_fetch->bind_param("i", $campaign_id);
        $stmt_fetch->execute();
        $stmt_fetch->bind_result($raised_amount);
        $stmt_fetch->fetch();
        $stmt_fetch->close();

      
        $new_raised_amount = $raised_amount + $amount;

   
        $sql_update = "UPDATE campaigns SET raised_amount = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("di", $new_raised_amount, $campaign_id);

        if ($stmt_update->execute()) {
            
            header("Location: thank_you.html");
            exit; 
        } else {
       
            echo "Error updating campaign: " . $stmt_update->error;
        }

        $stmt_update->close(); 
    } else {
      
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); 
} else {
   
    echo "All fields are required or user is not logged in.";
}

$conn->close(); 
?>
// process support.php  Done