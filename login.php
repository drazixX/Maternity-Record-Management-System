<?php
session_start();

// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mrm';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate user inputs
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = $_POST['password']; // Password should not be sanitized

// Prepare and execute SQL query
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if username exists and password matches
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Start session and store user information
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location: /MRM/admin/index.php"); // Redirect to dashboard
        exit();
    } else {
        $error = "Invalid username or password.";
    }
} else {
    $error = "Invalid username or password.";
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <link rel="stylesheet" href="asset/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="index.php" class="brand-link">
                    <img src="asset/img/logo.png" alt="Logo" width="200">
                </a>
            </div>
            <div class="card-body">
                <p class="text-danger"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></p>
                <a href="index.php">Go back to login</a>
            </div>
        </div>
    </div>
</body>
</html>
