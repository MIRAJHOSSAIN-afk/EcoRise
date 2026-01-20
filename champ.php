<?php
include 'config.php';


$sql = "SELECT id, title, goal, target_amount, raised_amount FROM campaigns";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns</title>
    <link rel="stylesheet" href="assets/css/campaigns.css"> 
</head>
<body>
    <div class="header">
        <h1>Our Campaigns</h1>
    </div>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
   
            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $title = $row['title']; 
                $goal = $row['goal'];
                $target_amount = $row['target_amount'];
                $raised_amount = $row['raised_amount'];
                $progress_percentage = ($raised_amount / $target_amount) * 100;
        ?>
        <div class="campaign">
            <h2><?php echo htmlspecialchars($goal); ?></h2>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($title); ?></p> 
            <p><strong>Target Amount:</strong> $<?php echo number_format($target_amount, 2); ?></p>
            <p><strong>Raised So Far:</strong> $<?php echo number_format($raised_amount, 2); ?></p>

    
            <div class="progress-bar">
                <div class="progress-bar-inner" style="width: <?php echo $progress_percentage; ?>%;"></div>
            </div>
            <p><strong>Progress:</strong> <?php echo round($progress_percentage, 2); ?>%</p>

         
            <div class="button-container">
                <a href="support.php?campaign_id=<?php echo $id; ?>">Support this Campaign</a>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No campaigns available at the moment.</p>";
        }
        ?>
    </div>
</body>
</html>

// done 
