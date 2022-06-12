<?php

include_once("dbconnect.php");
$postId = $_POST["postId"];
$email= $_POST['email'];
$comment = $_POST['comment'];

$sqlinsertcomment = "INSERT INTO tbl_comment(post_id,email,comment_text) VALUES('$postId','$email','$comment')";
if ($con->query($sqlinsertcomment) === TRUE){
    
    echo "success";
}else{
    echo "failed";
}

?>