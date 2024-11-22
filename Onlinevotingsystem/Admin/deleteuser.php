<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}


include("../../API/connect.php");


$userId = $_GET['id'];


$deleteQuery = "DELETE FROM user WHERE id='$userId'";

if (mysqli_query($connect, $deleteQuery)) {
    header("Location: viewusers.php");
    exit();
} else {
    echo "Error deleting user";
}
?>
