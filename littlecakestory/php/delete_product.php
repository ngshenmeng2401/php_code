<?php
error_reporting(0);
include_once("dbconnect.php");
$product_no = $_POST['product_no'];

$sqldelete = "DELETE FROM tbl_product  WHERE product_no  = '$product_no'";
    if ($con->query($sqldelete) === TRUE){
       echo "success";
    }else {
        echo "failed";
    }
?>