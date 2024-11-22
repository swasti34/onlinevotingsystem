// Connect to your database (make sure to change these settings to match your database configuration).

<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include("../../API/connect.php");



// Check if the admin has submitted a decision (e.g., via a form).
if (isset($_POST['decision'])) {
    $userId = $_POST['user_id'];  // Assuming you have a hidden input for user ID.
    $decision = $_POST['decision']; // 'accept' or 'reject'

    // Update the user's registration status in the database.
    $sql = "UPDATE registration_requests SET status = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $decision, $userId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Registration decision has been recorded.";
    } else {
        echo "Error: Unable to update registration status.";
    }

    mysqli_stmt_close($stmt);
}

// Display a list of registration requests to the admin (this part depends on your specific application).
// Loop through the database records and generate a list with accept/reject buttons.
?>

<!-- Example HTML for displaying registration requests -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch and display user registration requests
        $query = "SELECT user_id, username, email, status FROM registration_requests";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['email']}</td>";
            if ($row['status'] == 'pending') {
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <button type='submit' name='decision' value='accept'>Accept</button>
                            <button type='submit' name='decision' value='reject'>Reject</button>
                        </form>
                    </td>";
            } else {
                echo "<td>{$row['status']}</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
mysqli_close($conn);
?>
