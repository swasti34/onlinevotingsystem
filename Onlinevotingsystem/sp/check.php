<?php
include("../API/connect.php");

$registrationStatus = "Not Found"; // Default status

if (isset($_GET["voterId"])) {
    $voterId = $_GET["voterId"];

    // Check if the voterId is empty
    if (!empty($voterId)) {
        // Ensure your database connection is valid
        if ($connect) {
            $query = "SELECT confrimation FROM user WHERE voterid = '$voterId'";
            $result = mysqli_query($connect, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $registrationStatus = $row['confrimation'];
            }
        }
    }
    echo $registrationStatus; // Send the registration status as plain text
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <style>
        body {
            background-image: url('hello.png'); /* Replace with your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            margin: 20% auto;
            padding: 20px;
            max-width: 400px;
        }

        #status {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        #checkBtn {
            padding: 10px;
            border: none;
            background-color: blue;
            color: white;
            cursor: pointer;
        }

        #voterId {
            padding: 5px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Check Your Registration Status</h1>
        <label for="voterId">Enter Voter ID:</label>
        <input type="text" id="voterId" placeholder="Enter Voter ID">
        <button id="checkBtn">Check</button>
        <div id="status">
            Confirmation status: <span id="registrationStatus"></span><br>
        </div>
        <!-- Add a link to go back to login.php -->
        <a href="../index.html" style="text-decoration: none;"><br>
            <button style="padding: 10px; border: none; background-color: red; color: white; cursor: pointer;">Go Back to Login</button>
        </a>
    </div>
    <script>
        document.getElementById('checkBtn').addEventListener('click', function() {
            const voterId = document.getElementById('voterId').value;

            if (voterId.trim() !== '') {
                // Send a GET request to check.php to get the confirmation status
                fetch('check.php?voterId=' + voterId)
                .then(response => response.text())
                .then(data => {
                    const registrationStatus = document.getElementById('registrationStatus');
                    registrationStatus.textContent = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    const registrationStatus = document.getElementById('registrationStatus');
                    registrationStatus.textContent = 'An error occurred while checking the registration status.';
                });
            } else {
                const registrationStatus = document.getElementById('registrationStatus');
                registrationStatus.textContent = 'Voter ID is required.';
            }
        });
    </script>
</body>
</html>
