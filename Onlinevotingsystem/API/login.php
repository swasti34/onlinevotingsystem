<?php
session_start();

include("connect.php");

$mobile = $_POST['mobile'];
$password = hash('sha256', $_POST['password']); // Hash the entered password
$voterid = $_POST['voterid'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND voterid='$voterid' AND role='$role'");

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);

    // Check the confirmation status
    $confirmationStatus = $userdata['confrimation'];

    if ($confirmationStatus === 'Accepted') {
        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        echo '<script>
                alert(" Accepted. You are confirmed.");
                window.location = "../sp/dashboard.php";
              </script>';
    } elseif ($confirmationStatus === 'Rejected') {
        echo '<script>
                alert("Confirmation: Rejected. You are rejected.");
                window.location = "../";
              </script>';
    } elseif ($confirmationStatus === 'Pending') {
        echo '<script>
                alert("Confirmation: Pending. You are still under review.");
                window.location = "../";
              </script>';
    }
} else {
    echo '<script>
            alert("User not found!");
            window.location = "../";
          </script>';
}
?>
