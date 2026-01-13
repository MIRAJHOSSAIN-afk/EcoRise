<?php
session_start();

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $email            = trim($_POST['email'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($email === '' || $current_password === '' || $new_password === '' || $confirm_password === '') {
        $error = 'All fields are required.';
    } elseif ($new_password !== $confirm_password) {
        $error = 'New password and confirmation do not match.';
    } elseif (
        strlen($new_password) < 8 ||
        !preg_match('/[A-Z]/', $new_password) ||
        !preg_match('/[a-z]/', $new_password) ||
        !preg_match('/\d/', $new_password) ||
        !preg_match('/[^A-Za-z0-9]/', $new_password)
    ) {
        $error = 'Password must be at least 8 characters and include upper, lower, number, and symbol.';
    } else {
        $sql  = "SELECT id, password, user_status FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();

            if ($user['user_status'] === 'inactive') {
                $error = 'Your account is inactive. Please contact support.';
            } elseif (!password_verify($current_password, $user['password'])) {
                $error = 'Current password is incorrect.';
            } elseif (password_verify($new_password, $user['password'])) {
                $error = 'New password cannot be the same as the current password.';
            } else {
                $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $upd = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $upd->bind_param("si", $new_hash, $user['id']);
                if ($upd->execute()) {
                    $success = 'Password updated successfully. You can now sign in.';
                } else {
                    $error = 'Failed to update password. Please try again.';
                }
                $upd->close();
            }
        } else {
            $error = 'No account found with that email address.';
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="assets/css/change_password.css">
</head>
<body>

<?php if (!empty($success)): ?>
  <div id="changeSuccessPopup" style="position:fixed; top:10px; left:50%; transform:translateX(-50%); background-color:rgb(40,168,70); color:#fff; padding:14px 18px; border-radius:6px; z-index:999;">
    <?php echo htmlspecialchars($success); ?>
  </div>
  <script>
    setTimeout(function(){
      var el = document.getElementById('changeSuccessPopup');
      if (el) el.style.display = 'none';
    }, 3000);
  </script>
<?php endif; ?>

<div class="logo-container">
  <img src="assets/logo/eco.png" alt="EcoRise Logo">
</div>

<div class="changepass-container">
  <h2>Change Password</h2>

  <?php if (!empty($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <form action="change_password.php" method="POST" autocomplete="off">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your account email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" placeholder="At least 8 chars, mixed types" required>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter new password" required>

    <button type="submit">Update Password</button>

    <div class="form-footer">
      <p><a href="signin.php">Back to Sign In</a></p>
    </div>
  </form>
</div>
</body>
</html>
