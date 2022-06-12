<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloadcomment = "SELECT a.email as writerEmail, a.comment_id, a.comment_text, a.date_comment, c.post_id, c.email as postOwnerEmail, c.content, d.username, d.phone_no
FROM tbl_comment a
JOIN tbl_post c 
ON c.post_id = a.post_id
JOIN tbl_user d 
ON d.email= a.email 
WHERE a.email = '$email'

UNION

SELECT a.email as writerEmail, a.comment_id, a.comment_text, a.date_comment, c.post_id, c.email as postOwnerEmail, c.content, d.username, d.phone_no
FROM tbl_comment a
JOIN tbl_friend b 
ON b.friend_email = a.email 
JOIN tbl_post c 
ON c.post_id = a.post_id
JOIN tbl_user d 
ON d.email= a.email 
WHERE b.email = '$email'
ORDER BY comment_id ASC";

$result = $con->query($sqlloadcomment);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $commentlist = array();
        $commentlist[writerEmail] = $row['writerEmail'];
        $commentlist[comment_id] = $row['comment_id'];
        $commentlist[comment_text] = $row['comment_text'];
        $commentlist[date_comment] = $row['date_comment'];
        $commentlist[post_id] = $row['post_id'];
        $commentlist[postOwnerEmail] = $row['postOwnerEmail'];
        $commentlist[content] = $row['content'];
        $commentlist[username] = $row['username'];
        array_push($response,$commentlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>