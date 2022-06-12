<?php

include_once("dbconnect.php");
$email = $_POST['email'];
$friendEmail = $_POST['friendEmail'];
$friendStatus = "yes";

$sqladdFriend1 = "INSERT INTO tbl_friend(email,friend_email,friend_status) VALUES('$email','$friendEmail','$friendStatus')";
$sqladdFriend2 = "INSERT INTO tbl_friend(email,friend_email,friend_status) VALUES('$friendEmail','$email','$friendStatus')";

$sqldeleteRequest = "DELETE FROM tbl_request WHERE email = '$email' AND friend_email = '$friendEmail'";

if ($con->query($sqladdFriend1) === TRUE and $con->query($sqladdFriend2) === TRUE and $con->query($sqldeleteRequest) === TRUE){
    
    echo "success";
}else{
    echo "failed";
}

?>