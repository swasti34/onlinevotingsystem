<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $admin_username = "admin"; 
    $admin_password = "swauja"; 
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $admin_username && $input_password === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: admindashboard.php");
        exit();
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p.error-message {
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Admin Login</h2>
    <div class="login-form">
        <?php if (isset($error_message)) { echo '<p class="error-message">' . $error_message . '</p>'; } ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
    
</body>
</html>
