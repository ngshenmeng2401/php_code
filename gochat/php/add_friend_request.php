<?php

include_once("dbconnect.php");
$email = $_POST['email'];
$friendEmail = $_POST['friendEmail'];
$requestText = $_POST['requestText'];

$sqlsearch = "SELECT * FROM tbl_request WHERE email = '$email' AND friend_email = '$friendEmail'";

$result = $con->query($sqlsearch);
if ($result->num_rows > 0) {
    // while ($row = $result ->fetch_assoc()){
    //     $requestText = $row["request_message"];
    // }
    $sqladdrequest = "UPDATE tbl_request SET request_message = '$requestText' WHERE email = '$email' AND friend_email = '$friendEmail'";
    
}else{
    
    $sqladdrequest = "INSERT INTO tbl_request(email,friend_email,request_message) VALUES('$email','$friendEmail','$requestText')";
}



if ($con->query($sqladdrequest) === TRUE){
    
    echo "success";
}else{
    echo "failed";
}

?>