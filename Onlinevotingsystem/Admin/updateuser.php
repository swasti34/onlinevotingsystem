<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include("../API/connect.php");

$updateMessage = ''; // Initialize the update message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['newName'];
    $newMobile = $_POST['newMobile'];
    $newAddress = $_POST['newAddress'];
    $newConfrimation = $_POST['Confrimation'];
    $userId = $_GET['id'];

    $updateQuery = "UPDATE user SET name='$newName', mobile='$newMobile', address='$newAddress', confrimation='$newConfrimation' WHERE id='$userId'";

    if (mysqli_query($connect, $updateQuery)) {
        $updateMessage = 'User information updated successfully'; // Set success message
        echo "<script>alert('User information updated successfully'); window.location = 'viewusers.php';</script>"; // JavaScript alert and redirection
    } else {
        $updateMessage = 'Error updating user information'; // Set error message
    }
}

$userId = $_GET['id'];
$query = "SELECT * FROM user WHERE id='$userId'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
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

        form {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
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

        .message {
            text-align: center;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Update User Information</h2>
    <form method="POST">
        <label for "newName">New Name:</label>
        <input type="text" name="newName" value="<?php echo $row['name']; ?>" required><br>

        <label for="newMobile">New Mobile Number:</label>
        <input type="text" name="newMobile" value="<?php echo $row['mobile']; ?>" required><br>

        <label for="newAddress">New Address:</label>
        <input type="text" name="newAddress" value="<?php echo $row['address']; ?>" required><br>
        <label for="Confrimation">Confrimation:</label>
        <select name="Confrimation">
            <option value="Accepted" <?php if ($row['confrimation'] === 'Accepted') echo 'selected'; ?>>Accepted</option>
            <option value="Rejected" <?php if ($row['confrimation'] === 'Rejected') echo 'selected'; ?>>Rejected</option>
        </select><br>

        <input type="submit" value="Update">
    </form>
    <div class="message"><?php echo $updateMessage; ?></div>
</body>
</html>
