<?php

include_once("dbconnect.php");
$friendEmail = $_POST['friendEmail'];

$sqlloadfriendrequest= "SELECT * FROM tbl_request LEFT JOIN tbl_user ON tbl_request.email = tbl_user.email WHERE friend_email = '$friendEmail'";

// $sqlloadfriendrequest= "SELECT * FROM tbl_request WHERE friend_email = '$friendEmail'";

$result = $con->query($sqlloadfriendrequest);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $requestlist = array();
        $requestlist[friend_email] = $row['friend_email'];
        $requestlist[email] = $row['email'];
        $requestlist[request_message] = $row['request_message'];
        $requestlist[username] = $row['username'];
        $requestlist[phone_no] = $row['phone_no'];
        $requestlist[img_status] = $row['img_status'];
        array_push($response,$requestlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>