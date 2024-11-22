<?php
$connect =mysqli_connect("localhost","root","","voting");
if($connect){
    //echo"connected";
}
else{
    echo"not connected";
}


?>