<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include("../../API/connect.php");

$userId = $_GET['id'];

$confirmQuery = "UPDATE user SET status='confirmed' WHERE id='$userId'";

if (mysqli_query($connect, $confirmQuery)) {
    header("Location: viewusers.php");
    exit();
} else {
    echo "Error confirming user";
}
?>
