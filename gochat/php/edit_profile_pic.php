<?php

include_once("dbconnect.php");

$email = $_POST['email'];
$image = $_POST['image'];
$phoneNo = $_POST['phoneNo'];
$img_status = "yes";

$sqledituser = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = $con->query($sqledituser);
    if ($result->num_rows > 0) {
        
        $sqlupdate = "UPDATE tbl_user SET img_status = '$img_status' WHERE email = '$email'";
        
        if ($con->query($sqlupdate) === TRUE){
            $decoded_string = base64_decode($image);
            $path = '../images/user_profile/'.$phoneNo.'.png';
            $is_written = file_put_contents($path, $decoded_string);
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    else{
        echo "failed";
    }
    
?>