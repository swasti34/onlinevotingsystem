<?php
include("connect.php");

$name = $_POST['name'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$voterid = $_POST['voterid'];
$birth = $_POST["birth"];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$vcimage = $_FILES['vphoto']['name'];
$temp_name = $_FILES['vphoto']['tmp_name'];
$role = $_POST['role'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $birth = $_POST["birth"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Calculate the age based on the provided date of birth
    $today = new DateTime();
    $dob = new DateTime($birth);
    $age = $today->diff($dob)->y;

    // Check if the user is 18 or older
    if ($age >= 18) {
        $checkQuery = "SELECT COUNT(*) as count FROM user WHERE voterid = '$voterid'";
        $result = mysqli_query($connect, $checkQuery);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] > 0) {
            // Voter ID already registered
            echo '
            <script>
                alert("This voter ID is already registered. Please use a different voter ID.");
                window.location = "../sp/registration.html";
            </script>';
        } else {
            if ($password == $cpassword) {
                $hashedPassword = hash('sha256', $password);

                move_uploaded_file($tmp_name, "../uploads/$image");
                $insert = mysqli_query($connect, "INSERT INTO user(name,address,password,mobile,voterid,birth,photo,vphoto,role,status,votes) VALUES('$name','$address','$hashedPassword','$mobile','$voterid','$birth','$image','$vcimage','$role',0,0)");

                if ($insert) {
                    echo '
                    <script>
                        alert("Registration on pending!");
                        window.location = "../";
                    </script>';
                } else {
                    echo '
                    <script>
                        alert("Some error occurred!");
                        window.location = "../sp/registration.html";
                    </script>';
                }
            } else {
                echo '
                <script>
                    alert("Passwords do not match!");
                    window.location = "../sp/registration.html";
                </script>';
            }
        }
    } else {
        echo '
        <script>
            alert("You must be 18 or older to register!");
            window.location = "../sp/registration.html";
        </script>';
    }
}
?>
