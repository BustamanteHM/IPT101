<?php
session_start();
include 'db.php'; // FIXED PATH

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Fetch admin by username
        $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        // Check if account exists
        if ($admin) {
            // Verify password using SHA-256
            if (hash('sha256', $password) === $admin['password']) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $admin['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Both fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: #d8e46aff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 300px;
    }
    .login-box h2 {
      text-align: center;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }
    .login-box button {
      width: 100%;
      padding: 10px;
      background: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
    .error {
      color: red;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <?php if (!empty($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
