<?php

include_once("dbconnect.php");
$name = $_POST['name'];
$price = $_POST['price'];
$rating = $_POST['rating'];
$details = $_POST['details'];
$user_email = $_POST['email'];
$encoded_string = $_POST["encoded_string"];
$type = $_POST['type'];

$sqlinsert = "INSERT INTO tbl_product(product_name,original_price,rating,product_detail,user_email,type) VALUES('$name','$price','$rating','$details','$user_email','$type')";
if ($con->query($sqlinsert) === TRUE){
    $decoded_string = base64_decode($encoded_string);
    $filename = mysqli_insert_id($con);
    $path = '../images/product/'.$filename.'.png';
    $is_written = file_put_contents($path, $decoded_string);
    echo "success";
}else{
    echo "failed";
}

?>