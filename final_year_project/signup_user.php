<?php

include_once("dbconnect.php");

$username = $_POST['username'];
$email = $_POST['email'];
$phoneNo = $_POST['phoneNo'];
$password = $_POST['password'];
$referralCode = $_POST['referralCode'];
// $passha1 = sha1($password);
$otp = 0;
// $otp = rand(100000,999999);
$status = "active";

if($referralCode == "tasneem301199"){
    $position = "Teacher";
    
}else if ($referralCode == "tasneem240199"){
    $position = "Staff";
    
}else{
    $position = "Parent";
}
    
$sqlregister="INSERT INTO tbl_user(user_email,user_name,phone_no,password,position,otp,status) VALUES ('$email','$username','$phoneNo','$password','$position','$otp','$status')";
if($con->query($sqlregister) === TRUE){
    
    echo "Success";
}else{
    echo "Failed";
    
}

?>