<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['user_type'] !== 'admin') {
   
    header("Location: signin.php");
    exit();
}

include 'config.php'; 

$admin_name = $_SESSION['name'];

$total_campaigns = $conn->query("SELECT COUNT(*) AS total_campaigns FROM campaigns")->fetch_assoc()['total_campaigns'];

$total_users = $conn->query("SELECT COUNT(*) AS total_users FROM users WHERE user_type='user'")->fetch_assoc()['total_users'];

$total_donations = $conn->query("SELECT SUM(amount) AS total_donations FROM support")->fetch_assoc()['total_donations'];

$total_donations = $total_donations ? $total_donations : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/admin_homepage.css"> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>

<div class="admin-container">

    <header class="admin-header">
        <h1>Welcome, <?php echo htmlspecialchars($admin_name); ?></h1>
        <a href="logout.php" class="logout-btn"><b>Log Out</b></a>
    </header>

  
    <nav class="admin-nav">
        <ul>
            <li><a href="manage_campaigns.php">Manage Campaigns</a></li>
            <li><a href="view_users.php">View Users</a></li>
            <li><a href="add_campaign.php">Add New Campaign</a></li>
        </ul>
    </nav>


    <main class="admin-main">
        <h2>Dashboard Overview</h2>

     
        <div class="dashboard-stats">
            <div class="stat-box">
                <h3>Total Campaigns</h3>
                <p><?php echo $total_campaigns; ?></p>
            </div>
            <div class="stat-box">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="stat-box">
                <h3>Total Donations</h3>
                <p>$<?php echo number_format($total_donations, 2); ?></p>
            </div>
        </div>

        <div class="chart-container">
 
    <div class="chart-wrapper">
        <canvas id="campaignsChart"></canvas>
        <p>Total Campaigns</p>
    </div>

    <div class="chart-wrapper">
        <canvas id="usersChart"></canvas>
        <p>Total Users</p>
    </div>

    
    <div class="chart-wrapper">
        <canvas id="donationsChart"></canvas>
        <p>Total Donations</p>
    </div>
</div>

    </main>
</div>

<script>
    
const campaignsCtx = document.getElementById('campaignsChart').getContext('2d');
new Chart(campaignsCtx, {
    type: 'bar', 
    data: {
        labels: ['Total Campaigns'],
        datasets: [{
            label: 'Total Campaigns',
            data: [<?php echo $total_campaigns; ?>],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 50 
            }
        }
    }
});


const usersCtx = document.getElementById('usersChart').getContext('2d');
new Chart(usersCtx, {
    type: 'bar', 
    data: {
        labels: ['Total Users'],
        datasets: [{
            label: 'Total Users',
            data: [<?php echo $total_users; ?>],
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 50 
            }
        }
    }
});

const donationsCtx = document.getElementById('donationsChart').getContext('2d');
new Chart(donationsCtx, {
    type: 'bar', 
    data: {
        labels: ['Total Donations'],
        datasets: [{
            label: 'Total Donations',
            data: [<?php echo $total_donations; ?>],
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 50000 
            }
        }
    }
});

</script>

</body>
</html>
