<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - EcoRise</title>
    <link rel="stylesheet" href="assets/css/signin.css"> 
</head>
<body>

<?php if (!empty($signup_message)): ?>
<div id="signupSuccessPopup" style="display:block; position:fixed; top:10px; left:50%; transform:translateX(-50%); background-color:rgb(40, 168, 70); color: white; padding: 15px; border-radius: 5px;">
    <?php echo htmlspecialchars($signup_message); ?>
</div>
<script>
    setTimeout(function() {
        document.getElementById('signupSuccessPopup').style.display = 'none';
    }, 3000);
</script>
<?php endif; ?>

<div class="logo-container">
    <img src="assets/logo/eco.png" alt="EcoRise Logo"> 
</div>

<div class="signin-container">
    <h2>Sign In</h2>
    
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <form action="" method="POST">
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <button type="submit">Sign In</button>
    </form>
    
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</div>

</body>
</html>
