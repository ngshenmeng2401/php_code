<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloadlike = "SELECT a.email as writerEmail, a.like_id, a.like_status, c.post_id, c.email as postOwnerEmail, c.content, d.username, d.phone_no, d.img_status as profile_img
FROM tbl_like a
JOIN tbl_post c 
ON c.post_id = a.post_id
JOIN tbl_user d 
ON d.email= a.email 
WHERE a.email = '$email'

UNION

SELECT a.email as writerEmail, a.like_id, a.like_status, c.post_id, c.email as postOwnerEmail, c.content, d.username, d.phone_no, d.img_status as profile_img
FROM tbl_like a
JOIN tbl_friend b 
ON b.friend_email = a.email 
JOIN tbl_post c 
ON c.post_id = a.post_id
JOIN tbl_user d 
ON d.email= a.email 
WHERE b.email = '$email'

ORDER BY like_id ASC";

$result = $con->query($sqlloadlike);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $likelist = array();
        $likelist[writerEmail] = $row['writerEmail'];
        $likelist[like_id] = $row['like_id'];
        $likelist[like_status] = $row['like_status'];
        $likelist[post_id] = $row['post_id'];
        $likelist[postOwnerEmail] = $row['postOwnerEmail'];
        $likelist[content] = $row['content'];
        $likelist[username] = $row['username'];
        $likelist[phone_no] = $row['phone_no'];
        $likelist[profile_img] = $row['profile_img'];
        array_push($response,$likelist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>