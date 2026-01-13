<?php
include('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error = "name should only contain letters and spaces.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }
    elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    }
    elseif (
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/\d/', $password) ||
        !preg_match('/[^A-Za-z0-9]/', $password)
    ) {
        $error = 'Password must be characters and include upper, lower, number, and symbol.';
    }
    elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    }
    else {
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {
            $error = "This email is already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

            if (mysqli_query($conn, $sql)) 
            {
                
                session_start();

                $_SESSION['signup_success'] = "Signup successful!";
                header("Location: signin.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>
<body>
<div class="logo-container">
    <img src="assets/logo/eco.png" alt="EcoRise Logo">
</div>

<div class="signup-container">
    <h2>Sign Up</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="signup.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required pattern="[A-Za-z ]+" title="Name should only contain letters and spaces.">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
        </div>

        <button type="submit">Sign Up</button>

        <div class="form-footer">
            <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </form>
</div>
</body>
</html>
