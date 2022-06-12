<?php

include_once("dbconnect.php");
$postId = $_POST["postId"];
$email= $_POST['email'];

$sqlunlikepost = "DELETE FROM tbl_like WHERE post_id = '$postId' AND email = '$email'";

$sqlselectpost = "SELECT * FROM tbl_post WHERE post_id = '$postId'";

    $result = $con->query($sqlselectpost);
    if ($result->num_rows > 0){
        $sqlremovelike = "UPDATE tbl_post SET likes=likes-1 WHERE post_id = '$postId'";
    }

if ($con->query($sqlunlikepost) === TRUE and $con->query($sqlremovelike) === TRUE){
    
    echo "success";
}else{
    echo "failed";
}

?>