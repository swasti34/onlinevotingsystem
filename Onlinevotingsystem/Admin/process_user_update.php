<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include("../../API/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['newName'];
    $newMobile = $_POST['newMobile'];
    $newAddress = $_POST['newAddress'];
    $confrimation = $_POST['Confrimation']; // Updated variable name
    $userId = $_GET['id'];

    // Debug: Check what's received from the form
    echo "Received data:";
    var_dump($_POST);

    // Update the user's information and confirmation
    $updateQuery = "UPDATE user SET name='$newName', mobile='$newMobile', address='$newAddress', confrimation='$newconfrimation' WHERE id='$userId'";

    // Debug: Output the SQL query for further inspection
    echo "SQL Query: " . $updateQuery;

    if (mysqli_query($connect, $updateQuery)) {
        // Notify the user by sending an email
        $query = "SELECT * FROM user WHERE id='$userId'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);

        $to = $row['email']; // User's email address
        $subject = "Registration Status";
        $message = "Your registration status: $confrimation";
        $headers = "From: timro email rakha la"; // Admin's email address
        mail($to, $subject, $message, $headers);

        header("Location: viewusers.php");
        exit();
    } else {
        echo "Error updating user information: " . mysqli_error($connect);
    }
}
