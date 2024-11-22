<?php
session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated user information from the form
    $newName = $_POST['newName'];
    $newMobile = $_POST['newMobile'];
    $newAddress = $_POST['newAddress'];
    $newPassword = $_POST['newPassword'];

    // Get the user's ID from the session
    $userId = $_SESSION['userdata']['id'];

    // Update the user's information in the database
    $updateQuery = "UPDATE user SET name='$newName', mobile='$newMobile', address='$newAddress', password='$newPassword' WHERE id='$userId'";
    
    if (mysqli_query($connect, $updateQuery)) {
        // Update the session with the new user information (excluding the password)
        $_SESSION['userdata']['name'] = $newName;
        $_SESSION['userdata']['mobile'] = $newMobile;
        $_SESSION['userdata']['address'] = $newAddress;
        
        echo json_encode(["success" => true, "message" => "User information updated successfully"]);
        echo '<script>
                alert("User information updated successfully");
                window.location = "../sp/dashboard.php";
            </script>';
    } else {
        echo json_encode(["success" => false, "message" => "Error updating user information"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>



