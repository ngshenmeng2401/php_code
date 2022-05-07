<?php
error_reporting(0);
include_once("dbconnect.php");

$email = $_POST['email'];
$product_no = $_POST['product_no'];
$quantity = $_POST['quantity'];
$product_price = $_POST['product_price'];

$sqlupdate = "UPDATE tbl_cart SET product_qty = '$quantity' WHERE user_email = '$email' AND product_no = '$product_no' AND product_price = '$product_price'";

if ($con->query($sqlupdate) === true)
{
    echo "success";
}
else
{
    echo "failed";
}
    
$con->close();
?>