<?php

include_once("dbconnect.php");

$product_no = $_POST['product_no'];
$user_email = $_POST['email'];
$status = $_POST["status"];

$sqlinsert = "INSERT INTO tbl_favourite(product_no,user_email,status) VALUES('$product_no','$user_email','$status')";
if ($con->query($sqlinsert) === TRUE){
    echo "success";
}else{
    echo "failed";
}

?>