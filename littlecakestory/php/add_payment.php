<?php

include_once("dbconnect.php");

$dateTime = $_POST['dateTime'];
$message = $_POST['message'];
$address = $_POST['address'];
$total_payment = $_POST['total_payment'];
$email = $_POST['email'];
$paymentMethod = $_POST['paymentMethod'];
$item_qty = $_POST['item_qty'];

$sqlregister="INSERT INTO tbl_payment(user_email,item,total_payment,payment_method,message,address,delivery_date_time) VALUES ('$email','$item_qty','$total_payment','$paymentMethod','$message','$address','$dateTime')";
if($con->query($sqlregister) === TRUE){
    echo "success";
    $sqldelete = "DELETE FROM tbl_cart WHERE user_email = '$email'";
    $con->query($sqldelete);
}else{
    echo "failed";
}

?>