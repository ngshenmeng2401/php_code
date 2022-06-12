<?php

include_once("dbconnect.php");
$phoneNo = $_POST['phoneNo'];
$email = $_POST['email'];

$sqlsearchuser = "SELECT * FROM tbl_user WHERE phone_no LIKE '%$phoneNo%'";

$result = $con->query($sqlsearchuser);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        
        $searchEmail = $row["email"];
        
        $sqlloadfriend = "SELECT * FROM tbl_friend WHERE friend_email = '$searchEmail' AND email = '$email'";
        $result2 = $con->query($sqlloadfriend);
        
        if (mysqli_num_rows($result2) == 1 ){
            
            $action = "added";
        }else{
            
            $action = "add";
        }
        
        $userlist = array();
        $userlist[email] = $searchEmail;
        $userlist[username] = $row['username'];
        $userlist[phone_no] = $row['phone_no'];
        $userlist[img_status] = $row['img_status'];
        $userlist[action] = $action;
        array_push($response,$userlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>