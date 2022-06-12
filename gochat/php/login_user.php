<?php

error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$password = $_POST['password'];

$sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' AND otp = '0'";
$result = $con->query($sqllogin);
if($result->num_rows>0){
    while($row = $result ->fetch_assoc()){
        echo $data = "success,".$row["email"].",".$row["username"].",".$row["phone_no"].",".$row["date_reg"].",".$row["status"].",".$quantity;
        // echo "success";
    }
}else{
    echo "failed";
}
?>