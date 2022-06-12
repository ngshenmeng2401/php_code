<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloadcontact= "SELECT tbl_friend.friend_email , tbl_friend.friend_status , tbl_user.username , tbl_user.phone_no, tbl_user.img_status FROM tbl_friend LEFT JOIN tbl_user ON tbl_friend.friend_email = tbl_user.email WHERE tbl_friend.email = '$email'";

$result = $con->query($sqlloadcontact);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $contactlist = array();
        $contactlist[friend_email] = $row['friend_email'];
        $contactlist[friend_status] = $row['friend_status'];
        $contactlist[username] = $row['username'];
        $contactlist[phone_no] = $row['phone_no'];
        $contactlist[img_status] = $row['img_status'];
        array_push($response,$contactlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>