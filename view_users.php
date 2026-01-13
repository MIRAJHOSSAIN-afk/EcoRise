<?php

include('config.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $updateQuery = "UPDATE users SET user_status = '" . $status . "' WHERE id = '" . $id . "'";
    mysqli_query($conn, $updateQuery);
    header("Location: view_users.php");
    exit();
}

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = "AND (name LIKE '%" . $_POST['search'] . "%' OR email LIKE '%" . $_POST['search'] . "%')";
}

$query = "
    SELECT u.id, u.name, u.email, u.user_type, u.user_status,
    COALESCE(SUM(s.amount), 0) AS total_donated
    FROM users u
    LEFT JOIN support s ON u.id = s.user_id
    WHERE u.user_type != 'admin' $searchQuery
    GROUP BY u.id
    ORDER BY u.id ASC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/css/view_users.css">
</head>

<body>
    <div class="admin-container">
        
        <div class="admin-header">
            <h1>View Users</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        
        <div class="search-container">
            <form method="POST">
                <input type="text" name="search" placeholder="Search by Name or Email"
                    value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>User Status</th>
                        <th>Total Donation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo ucfirst($user['user_type']); ?></td>
                            <td><?php echo ucfirst($user['user_status']); ?></td>
                            <td>$<?php echo number_format($user['total_donated'], 2); ?></td>
                            <td>
                                <?php if ($user['user_status'] === 'active') { ?>
                                    <a href="view_users.php?id=<?php echo $user['id']; ?>&status=inactive"
                                        class="deactivate-btn">Inactivate</a>
                                <?php } else { ?>
                                    <a href="view_users.php?id=<?php echo $user['id']; ?>&status=active"
                                        class="activate-btn">Activate</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>