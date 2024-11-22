<?php
include("../../API/connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if($password==$cpassword){
    move_uploaded_file($tmp_name, "../../uploads/$image");
     $insert = mysqli_query($connect, "INSERT INTO user(name,mobile,address,password,photo,role,status,votes) VALUES('$name','$mobile','$address','$password','$image','$role',0,0)");
     if($insert){
        echo '
        <script>
            alert("registration sucessfull!");
            window.location = "viewusers.php";
        </script>
        ';
}else{
echo '
<script>
            alert("some error occur!");
            window.location = "adduser.html";
        </script>
        ';
}
}else{ 
    echo '
    <script>
            alert("Passwords do not match!");
            window.location = "adduser.html";
        </script>';
}


?>


