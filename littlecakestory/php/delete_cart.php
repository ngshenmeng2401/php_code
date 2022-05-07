<?php
error_reporting(0);
include_once("dbconnect.php");

$product_no = $_POST['product_no'];
$email = $_POST['email'];
$product_price = $_POST['product_price'];

$sqldelete = "DELETE FROM tbl_cart WHERE user_email = '$email' AND product_no = '$product_no' AND product_price = '$product_price'";


if ($con->query($sqldelete) === TRUE){
   echo "success";
}else {
    echo "failed";
}
?>