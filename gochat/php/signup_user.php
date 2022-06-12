<?php

include_once("dbconnect.php");

$username = $_POST['username'];
$email = $_POST['email'];
$phoneNo = $_POST['phoneNo'];
$password = $_POST['password'];
$otp = 0;
$img_status = "noimage";
$status = "active";
    
$sqlregister="INSERT INTO tbl_user(email,username,password,phone_no,otp,img_status,status) VALUES ('$email','$username','$password','$phoneNo','$otp','$img_status','$status')";
if($con->query($sqlregister) === TRUE){
    
    echo "success";
}else{
    echo "failed";
    
}

?>