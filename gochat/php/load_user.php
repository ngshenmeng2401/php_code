<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloaduser= "SELECT * FROM tbl_user WHERE email = '$email'";

$result = $con->query($sqlloaduser);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $userlist = array();
        $userlist[username] = $row['username'];
        $userlist[phone_no] = $row['phone_no'];
        $userlist[img_status] = $row['img_status'];
        array_push($response,$userlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>