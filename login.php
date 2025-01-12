<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session only once at the beginning
session_start();
require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header('Content-Type: application/json');
        echo json_encode([
            "status" => "error",
            "message" => "Username and password are required"
        ]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "success",
                "username" => $user['username']
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "error",
                "message" => "Invalid credentials"
            ]);
        }
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode([
            "status" => "error",
            "message" => "Database error"
        ]);
    }
    exit;
}

function loginUser($username, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return $user;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

function handleLogin($response) {
    if ($response['status'] === "success") {
        $_SESSION['currentUser'] = $response['username'];
        echo "<script>
            localStorage.setItem('currentUser', '" . $response['username'] . "');
            window.location.href = 'game/index.html';
        </script>";
        exit;
    } else {
        return "Login failed: " . $response['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RPG Fantasy</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div id="login-form">
            <h2>Login to RPG Fantasy</h2>
            <form id="loginForm">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <!-- Load RPG Maker core scripts first -->
    <script type="text/javascript" src="game/js/rpg_core.js"></script>
    <script type="text/javascript" src="game/js/rpg_managers.js"></script>
    <script type="text/javascript" src="game/js/rpg_objects.js"></script>
    
    <!-- Then load LoginSystem.js -->
    <script type="text/javascript" src="game/js/plugins/LoginSystem.js"></script>
    
    <!-- Finally add the form handling script -->
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        
        fetch(window.location.pathname, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'username': username,
                'password': password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                localStorage.setItem("currentUser", data.username);
                window.location.href = "game/index.html";
            } else {
                alert("Login failed: " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
</body>
</html>