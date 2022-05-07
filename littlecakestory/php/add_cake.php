<?php

include_once("dbconnect.php");
$encoded_string = $_POST["encoded_string"];
$name = $_POST['name'];
$price = $_POST['price'];
$rating = $_POST['rating'];
$details = $_POST['details'];
$user_email = $_POST['email'];
$selected_slice = $_POST['selected_slice'];
$selected_6Inch = $_POST['selected_6Inch'];
$selected_8Inch = $_POST['selected_8Inch'];
$selected_10Inch = $_POST['selected_10Inch'];
$type = $_POST['type'];

$sqlinsert = "INSERT INTO tbl_product(product_name,original_price,rating,product_detail,slice,6_inch,8_inch,10_inch,user_email,type) VALUES('$name','$price','$rating','$details','$selected_slice','$selected_6Inch','$selected_8Inch','$selected_10Inch','$user_email','$type')";
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