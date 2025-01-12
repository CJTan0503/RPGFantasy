<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Validate input
    if (empty($username) || empty($password) || empty($email)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            // Use the registerUser function from functions.php
            if (registerUser($username, $password, $email)) {
                echo "<script>
                    alert('Registration successful! Please proceed to login.');
                    window.location.href = 'login.php';
                </script>";
                exit;
            } else {
                $error = "Registration failed. Username or email may already exist.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>alert('Username or email already exists.');</script>";
            } else {
                echo "<script>alert('Registration error: " . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RPG Fantasy</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div id="register-form">
            <h2>Register to RPG Fantasy</h2>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>