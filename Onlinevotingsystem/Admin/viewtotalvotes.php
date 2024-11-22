<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection code
include("../API/connect.php");


$query = "SELECT name, votes FROM user WHERE role = 2";


$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Total Votes</title>
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
            padding-top: 50px; 
        }

        table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 80%;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    
<a href="admindashboard.php" ><button style="padding: 10px;
        border-radius: 5px;
        width: 10%;
        background-color:blue;
        color:white;">Back</button></a>
<br/>
    <h2>Total Votes</h2>
    <table>
        <tr>
            <th>Group Name</th>
            <th>Total Votes</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['votes']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
