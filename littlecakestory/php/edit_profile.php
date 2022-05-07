<?php

include_once("dbconnect.php");

$user_email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phoneno = $_POST['phoneno'];
$encoded_string = $_POST["encoded_string"];

$sql = "SELECT * FROM tbl_user WHERE user_email = '$user_email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_user SET first_name = '$firstname', last_name = '$lastname', phone_no = '$phoneno', phone_no = '$phoneno' WHERE user_email = '$user_email'";
        if ($con->query($sqlupdate) === TRUE){
                    $decoded_string = base64_decode($encoded_string);
                    $filename = mysqli_insert_id($con);
                    $path = '../images/profile_image/'.$filename.'.png';
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