<?php

declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include('config.php'); 
function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

if (isset($_GET['id'])) {
    $delete_id = (int)$_GET['id'];
    if ($delete_id > 0) {
        $stmt = $conn->prepare("DELETE FROM campaigns WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo "<script>alert('Campaign deleted successfully!'); window.location.href = 'manage_campaigns.php';</script>";
        } else {
            echo "<script>alert('Error deleting campaign. Please try again.'); window.location.href = 'manage_campaigns.php';</script>";
        }
        exit;
    } else {
        echo "<script>alert('Invalid delete request.'); window.location.href = 'manage_campaigns.php';</script>";
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['campaign_id'])) {
    $campaign_id   = isset($_POST['campaign_id']) ? (int)$_POST['campaign_id'] : 0;
    $title         = trim($_POST['title'] ?? '');
    $goal          = trim($_POST['goal'] ?? '');
    $target_amount = trim($_POST['target_amount'] ?? '');

    if ($campaign_id <= 0) {
        echo "<script>alert('Invalid campaign ID.'); window.history.back();</script>";
        exit;
    }

    
    if (!preg_match('/^[A-Za-z\s]+$/', $title)) {
        echo "<script>alert('Invalid title. Only letters and spaces are allowed.'); window.history.back();</script>";
        exit;
    }

 
    if ($target_amount === '' || !is_numeric($target_amount)) {
        echo "<script>alert('Target amount must be a valid number.'); window.history.back();</script>";
        exit;
    }
    $target_amount_num = (float)$target_amount;
    if ($target_amount_num < 0) {
        echo "<script>alert('Target amount cannot be negative.'); window.history.back();</script>";
        exit;
    }


    if ($goal !== '' && is_numeric($goal) && (float)$goal < 0) {
        echo "<script>alert('Goal cannot be a negative number.'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare("UPDATE campaigns SET title = ?, goal = ?, target_amount = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $title, $goal, $target_amount_num, $campaign_id);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        echo "<script>alert('Campaign updated successfully!'); window.location.href = 'manage_campaigns.php';</script>";
    } else {
        echo "<script>alert('Error updating campaign. Please try again.');</script>";
    }
    exit;
}


$searchTerm = '';
$whereSql = '';
$params = [];
$types  = '';

if (isset($_POST['search'])) {
    $searchTerm = trim($_POST['search']);
    if ($searchTerm !== '') {
        $whereSql = "WHERE title LIKE ? OR goal LIKE ?";
        $like = "%{$searchTerm}%";
        $params = [$like, $like];
        $types  = 'ss';
    }
}


$sql = "SELECT id, title, goal, target_amount, created_at FROM campaigns ";
if ($whereSql) { $sql .= $whereSql . " "; }
$sql .= "ORDER BY created_at DESC";

if ($whereSql) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manage Campaigns</title>
    <link rel="stylesheet" href="assets/css/manage_campaigns.css"/>
</head>

<body>
 
    <div class="admin-container">

        <div class="admin-header">
            <h1>Manage Campaigns</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="search-container">
            <form method="POST" action="manage_campaigns.php">
                <input type="text" name="search" placeholder="Search by Title or Goal" value="<?php echo e($searchTerm); ?>"/>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Goal</th>
                    <th>Target Amount</th>
                    <th class="actions-column">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($campaign = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo (int)$campaign['id']; ?></td>
                            <td><?php echo e($campaign['title']); ?></td>
                            <td><?php echo e($campaign['goal']); ?></td>
                            <td>$<?php echo number_format((float)$campaign['target_amount'], 2); ?></td>
                            <td>
                                <button
                                    class="edit-btn action-btn"
                                    type="button"
                                    data-id="<?php echo (int)$campaign['id']; ?>"
                                    data-title="<?php echo e($campaign['title']); ?>"
                                    data-goal="<?php echo e($campaign['goal']); ?>"
                                    data-target="<?php echo e((string)$campaign['target_amount']); ?>"
                                    onclick="openModalFromBtn(this)"
                                >Edit</button>

                                <a
                                    href="manage_campaigns.php?id=<?php echo (int)$campaign['id']; ?>"
                                    class="delete-btn action-btn"
                                    onclick="return confirm('Are you sure you want to delete this campaign?');"
                                >Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No campaigns found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

  
    <div id="editModal" class="modal" aria-hidden="true">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-header">Edit Campaign</div>
            <form id="editForm" action="manage_campaigns.php" method="POST" novalidate>
                <input type="hidden" name="campaign_id" id="campaign_id"/>

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required pattern="[A-Za-z\s]+"/>

                <label for="goal">Goal:</label>
                <input type="text" id="goal" name="goal" placeholder="Text allowed; if number, must be ≥ 0"/>

                <label for="target_amount">Target Amount:</label>
                <input type="number" id="target_amount" name="target_amount" step="0.01" min="0" required/>

                <button type="submit">Done</button>
            </form>
        </div>
    </div>

    <script>
        function openModalFromBtn(btn) {
            const id     = btn.getAttribute('data-id');
            const title  = btn.getAttribute('data-title') || '';
            const goal   = btn.getAttribute('data-goal') || '';
            const target = btn.getAttribute('data-target') || '';

            document.getElementById('campaign_id').value = id;
            document.getElementById('title').value = title;
            document.getElementById('goal').value = goal;
            document.getElementById('target_amount').value = target;

            document.getElementById('editModal').style.display = 'block';
            document.getElementById('editModal').setAttribute('aria-hidden', 'false');
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('editModal').setAttribute('aria-hidden', 'true');
        }

        window.onclick = function (event) {
            if (event.target === document.getElementById('editModal')) {
                closeModal();
            }
        };
    </script>
</body>
</html>
// Campaign managemnt complete
