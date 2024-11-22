<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
            padding-top: 50px; /* Adjust as needed */
        }

        ul.navbar {
            list-style-type: none;
            padding: 0;
            text-align: center;
            background-color: #333; /* Background color for the navigation bar */
        }

        ul.navbar li {
            display: inline;
            margin: 10px;
        }

        ul.navbar li a {
            text-decoration: none;
            color: #fff; /* Text color for regular links */
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
        }

        ul.navbar li a:hover {
            background-color: #007BFF; /* Background color on hover */
            color: #fff; /* Text color on hover */
        }
    </style>
</head>
<body>
    <h2>Welcome Admin</h2>
    <ul class="navbar">
        <li><a href="viewusers.php">Manage Users</a></li>
        <li><a href="viewtotalvotes.php">View Total Votes</a></li>
        <li><a href="adduser.html">Add Users</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>


