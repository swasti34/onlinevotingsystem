<?php
session_start();
include("../API/connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Information</title>
    <!-- Include SweetAlert2 (Swal) script here -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['newName'];
    $newMobile = $_POST['newMobile'];
    $newAddress = $_POST['newAddress'];

    // Get the user's ID from the session or wherever it's stored
    $userId = $_SESSION['userdata']['id'];

    // Update the user's information
    $updateQuery = "UPDATE user SET name='$newName', mobile='$newMobile', address='$newAddress' WHERE id='$userId'";

    if (mysqli_query($connect, $updateQuery)) {
        // Update successful, show a success message and redirect to the dashboard
        echo '<script>
        Swal.fire({
            title: "Success!",
            text: "User information updated successfully",
            icon: "success",
            showConfirmButton: false,
            timer: 2000, // 2000 milliseconds = 2 seconds
        }).then(function() {
            window.location = "dashboard.php";
        });
    </script>';

    } else {
        // Failed to update, show an error message
        echo '<script>
            Swal.fire({
                title: "Error",
                text: "Failed to update user information",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
} else {
    // Handle this case as needed, maybe show an error message
    echo "Invalid request.";
}
?>
</body>
</html>
