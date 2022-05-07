<?php

include_once("dbconnect.php");

$streetAddress = $_POST['streetAddress'];
$postalCode = $_POST['postalCode'];
$city = $_POST['city'];
$state = $_POST['state'];
$place = $_POST['place'];
$email = $_POST['email'];

$sqlregister="INSERT INTO tbl_user_address(place,street_address,postal_code,city,state,user_email) VALUES ('$place','$streetAddress','$postalCode','$city','$state','$email')";
if($con->query($sqlregister) === TRUE){
    echo "success";
}else{
    echo "failed";
}

?>