<?php
session_start();

include("../API/connect.php");
if(!isset($_SESSION['userdata'])){
    header("location:../");
}
$userdata=$_SESSION['userdata'];
$groupsdata=$_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status='<b style="color:red">Not Voted</b>';
}
else{
    $status='<b style="color:green">Voted</b>';
}

// Fetch user data from the database
$userId = $_SESSION['userdata']['id']; // Assuming 'id' is the user's ID in the database
$query = "SELECT * FROM user WHERE id = $userId";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    // Handle the case where user data cannot be retrieved
    $row = array(); // Set an empty user data array or show an error
}


?>

<html>
    <head>
        <title>Online Voting System-Dashboard</title>
        <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <style>
         
        body {
            background-image: url('hello.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #backbtn{
            padding: 5px;
	border-radius: 5px;
	background-color: purple;
	color:white;
    float:left;
    margin:5px;
}


        #logoutbtn{
            padding: 5px;
	border-radius: 5px;
	background-color: purple;
	color:white;
    float:right;
    margin:5px;
    
}


#Profile{
    background-color:white;
    width: 30%;
padding: 20px;
float: left;
}
#Group{
    background-color:white;
    width: 60%;
padding: 20px;
float: right;
}
#votebtn{
    padding: 5px;
	border-radius: 5px;
	background-color: purple;
	color:white;

}
#mainsection{
    padding:10px;
}
#voted{
    padding: 5px;
	border-radius: 5px;
	background-color: green;
	color:white;
}
    #Update{
        padding: 5px;
	border-radius: 5px;
	background-color: green;
	color:white;
    

    }
   
    .edit-button {
  background-color: #3498db; 
  color: #fff; 
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.edit-button:hover {
  background-color: #e74c3c; 
}

.icon {
  margin-right: 5px; 
}




            
        
        </style>
<div id="mainsection">

<center>
<div id="headersection">
<a href../><button id="backbtn">Back</button></a>
<a href="logout.php"><button id="logoutbtn">logout</button></a>

    <h1>Online Voting System</h1>
    
    </div>
</center>
    <hr>
    
    <div id="Profile">
    <center> <img src="../uploads/<?php echo $row["photo"]?>" height="200" width="200"></center><br><br>
    <b>Name:</b> <?php echo $row['name'] ?><br><br>
    <b>Mobile:</b> <?php echo $row['mobile'] ?><br><br>
    <b>Address:</b> <?php echo $row['address'] ?><br><br>
    <b>VoterID:</b> <?php echo $row['voterid'] ?><br><br>
    <b>Status:</b> <?php echo $status ?><br><br>


<!-- Add an Edit button -->
<button id="editButton" class="edit-button">
  <span class="icon">✎</span> Edit
</button>


<div id="editForm" style="display: none;">
    <form method="post" action="update_user.php">
        <label for="newName" style="  font-weight: bold;">New Name:</label>
        <input type="text" name="newName" value="<?php echo $userdata['name'] ?>"><br>

        <label for="newMobile" style="  font-weight: bold;">New Mobile Number:</label>
        <input type="text" name="newMobile" value="<?php echo $userdata['mobile'] ?>"><br>

        <label for="newAddress" style="  font-weight: bold;">New Address:</label>
        <input type="text" name="newAddress" value="<?php echo $userdata['address'] ?>"><br>

        <input type="submit" value="Save">
    </form>
</div>

</div>
<div id="Group">
    <?php
    if($_SESSION['groupsdata']){
        for($i=0; $i<count($groupsdata); $i++){
            ?>
            <div>
                <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>"height="100" width="100">
                <b>Group Name:</b><?php echo $groupsdata[$i]['name']?><br><br>
                <b>Votes:</b><?php echo $groupsdata[$i]['votes']?><br><br>
                <form action="../API/vote.php" method="POST">
    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
    <?php
    if($_SESSION['userdata']['status']==0){
        ?>
         <input type="submit" name="votebtn" value="vote" id="votebtn">
         <?php
         } else{
                        ?>
                         <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                        <?php
         }
                        ?>
                        </form>
        </div>
        <hr>
        <?php
        }
    }
    else{

    }
    ?>
    </div>
</div>
</div>
<script>
const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('editForm');

    editButton.addEventListener('click', function () {
        editForm.style.display = 'block';
        editButton.style.display = 'none'; // Hide the Edit button
    });
   </script>
    </body>
</html>