<?php

include_once("dbconnect.php");
$postId = $_POST["postId"];
$email= $_POST['email'];
$status = "yes";
        
$sqllikepost = "INSERT INTO tbl_like(email,post_id,like_status) VALUES('$email','$postId','$status')";


$sqlselectpost = "SELECT * FROM tbl_post WHERE post_id = '$postId'";

    $result = $con->query($sqlselectpost);
    if ($result->num_rows > 0){
        $sqladdlike = "UPDATE tbl_post SET likes=likes+1 WHERE post_id = '$postId'";
    }

if ($con->query($sqllikepost) === TRUE and $con->query($sqladdlike) === TRUE){
    
    echo "success";
}else{
    echo "failed";
}

?>