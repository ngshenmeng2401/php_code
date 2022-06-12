<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$commentId = $_POST['commentId'];

$sqldelete = "DELETE FROM tbl_comment WHERE comment_id = '$commentId' AND email = '$email'";
    if ($con->query($sqldelete) === TRUE){
        
       echo "success";
    }else {
        echo "failed";
    }
?>