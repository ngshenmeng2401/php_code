<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloadpost= "SELECT * FROM tbl_post WHERE email = '$email' ORDER BY post_id DESC";

$result = $con->query($sqlloadpost);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $postlist = array();
        $postlist[post_id] = $row['post_id'];
        $postlist[content] = $row['content'];
        $postlist[img_status] = $row['img_status'];
        $postlist[date_post] = $row['date_post'];
        array_push($response,$postlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>