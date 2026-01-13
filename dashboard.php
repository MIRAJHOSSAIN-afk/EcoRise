<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

require 'config.php';

$user_id = $_SESSION['user_id'];
$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $address  = trim($_POST['address'] ?? '');
    $contact  = trim($_POST['contact'] ?? '');

   
    if ($name === '') {
        $errors[] = "Name cannot be empty.";
    }

    if (!$errors) {
        $sql_upd = "UPDATE users SET name=?, address=?, contact=? WHERE id=?";
        $stmt = $conn->prepare($sql_upd);
        $stmt->bind_param("ssssi", $name, $address, $contact, $user_id);

        if ($stmt->execute()) {
            $success = "Profile updated successfully.";
        } else {
            $errors[] = "Update failed. Try again.";
        }
        $stmt->close();
    }
}


$sql_user = "SELECT name, email, address, contact FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$user_result = $stmt_user->get_result();
$user_info = $user_result->fetch_assoc();


$sql_support = "
    SELECT campaigns.id AS campaign_id, campaigns.goal, support.amount, campaigns.title
    FROM support
    JOIN campaigns ON support.campaign_id = campaigns.id
    WHERE support.user_id = ?
";
$stmt_support = $conn->prepare($sql_support);
$stmt_support->bind_param("i", $user_id);
$stmt_support->execute();
$support_result = $stmt_support->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($user_info['name']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($user_info['email']); ?></p>
    </div>

    <div class="container">

        <?php if ($success): ?>
            <div class="message-box success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div class="message-box error">
                <?php foreach ($errors as $e): ?>
                    <div><?php echo htmlspecialchars($e); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

   
        <div class="form-section">
            <h2>Your Profile</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($user_info['address']); ?>">
                </div>
                <div class="form-group">
                    <label>Contact:</label>
                    <input type="text" name="contact" value="<?php echo htmlspecialchars($user_info['contact']); ?>">
                </div>
                <button type="submit" class="support-button">Save Changes</button>
            </form>
        </div>

      
        <div class="user-info">
            <h2>Your Supported Campaigns</h2>
            <table>
                <thead>
                    <tr>
                        <th>Campaign Goal</th>
                        <th>Title</th>
                        <th>Amount Donated</th>
                        <th>Support More</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($support_result->num_rows > 0): ?>
                        <?php while ($row = $support_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['goal']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td>$<?php echo htmlspecialchars($row['amount']); ?></td>
                                <td>
                                    <a href="support.php?campaign_id=<?php echo (int)$row['campaign_id']; ?>" class="support-button">Support More</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4">You have not supported any campaigns yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$stmt_user->close();
$stmt_support->close();
$conn->close();
?>
