<?php

error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
// $password = sha1($_POST['password']);
$password = $_POST['password'];
$position = $_POST['position'];

$sqllogin = "SELECT * FROM tbl_user WHERE user_email = '$email' AND password = '$password' AND otp = '0' AND position = '$position'";
$result = $con->query($sqllogin);
if($result->num_rows>0){
    while($row = $result ->fetch_assoc()){
        echo $data = "success,".$row["user_name"].",".$row["phone_no"].",".$row["date_reg"].",".$row["credit"].",".$row["status"].",".$quantity;
        // echo "success";
    }
}else{
    echo "failed";
}
?>