<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}


include("../API/connect.php");


$query = "SELECT * FROM user"; 
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
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

        .action-buttons a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        .confirm-delete,
        .confirm-update {
            display: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 20% auto;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .modal-buttons {
            text-align: center;
            margin-top: 20px;
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
    <h2>User List</h2>
    <hr>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            
            <th>Confirmation</th>
            <th>Action</th>
           
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['address']; ?></td>
                
                <td><?php echo $row['confrimation']; ?></td>
                <td class="action-buttons">
                    <a href="javascript:void(0);" onclick="showUpdateConfirmation(<?php echo $row['id']; ?>)">Update</a> |
                    <a href="javascript:void(0);" onclick="showDeleteConfirmation(<?php echo $row['id']; ?>)">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <hr>
    <!-- Update Confirmation Modal -->
    <div class="modal" id="updateModal">
        <div class="modal-content">
            <h3>Update User?</h3>
            <div class="modal-buttons">
                <button onclick="updateUser()">Yes</button>
                <button onclick="cancelUpdate()">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <h3>Delete User?</h3>
            <div class="modal-buttons">
                <button onclick="deleteUser()">Yes</button>
                <button onclick="cancelDelete()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        var selectedUserId;

        function showUpdateConfirmation(userId) {
            selectedUserId = userId;
            document.getElementById("updateModal").style.display = "block";
        }

        function showDeleteConfirmation(userId) {
            selectedUserId = userId;
            document.getElementById("deleteModal").style.display = "block";
        }

        function updateUser() {
            // Redirect to the update user page with the selectedUserId
            window.location.href = 'updateuser.php?id=' + selectedUserId;
        }

        function cancelUpdate() {
            document.getElementById("updateModal").style.display = "none";
        }

        function deleteUser() {
            // Redirect to the delete user page with the selectedUserId
            window.location.href = 'deleteuser.php?id=' + selectedUserId;
        }

        function cancelDelete() {
            document.getElementById("deleteModal").style.display = "none";
        }

        function showConfirmConfirmation(userId) {
    selectedUserId = userId;
    if (confirm("Are you sure you want to confirm this user's details?")) {
        // Send a confirmation request to the server
        fetch('confirmuser.php?id=' + selectedUserId)
            .then(response => {
                if (response.ok) {
                    // Handle success (e.g., display a success message)
                    alert("User details confirmed successfully.");
                } else {
                    // Handle error (e.g., display an error message)
                    alert("Error confirming user details.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}
    </script>
</body>
</html>
