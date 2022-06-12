<?php

include_once("dbconnect.php");
$email = $_POST['email'];

$sqlloadmoment = "SELECT a.email as writerEmail, a.post_id, a.content, a.img_status as moment_img, a.date_post, a.likes, d.username, d.phone_no, d.img_status as profile_img 
FROM tbl_post a 
JOIN tbl_user d 
ON d.email= a.email 
WHERE a.email = '$email' AND a.img_status = 'yes'

ORDER BY post_id DESC
LIMIT 4";

$result = $con->query($sqlloadmoment);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        
        $postId = $row["post_id"];
        
        $sqlloadlike = "SELECT * FROM tbl_like WHERE email = '$email' AND post_id= '$postId'";
        $result2 = $con->query($sqlloadlike);
        
        if (mysqli_num_rows($result2) == 1 ){
            
            $likeaction = "like";
        }else{
            
            $likeaction = "unlike";
        }
        
        $momentlist = array();
        $momentlist[writerEmail] = $row['writerEmail'];
        $momentlist[post_id] = $row['post_id'];
        $momentlist[content] = $row['content'];
        $momentlist[moment_img] = $row['moment_img'];
        $momentlist[date_post] = $row['date_post'];
        $momentlist[likes] = $row['likes'];
        $momentlist[username] = $row['username'];
        $momentlist[phone_no] = $row['phone_no'];
        $momentlist[profile_img] = $row['profile_img'];
        $momentlist[likeaction] = $likeaction;
        array_push($response,$momentlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>