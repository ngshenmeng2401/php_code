<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$postId = $_POST['postId'];
$imgStatus = $_POST['imgStatus'];

$sqldelete = "DELETE FROM tbl_post WHERE post_id = '$postId' AND email = '$email'";
    if ($con->query($sqldelete) === TRUE){
        
        if($imgStatus == "yes"){
            
            unlink("../images/post/".$postId.".png");
        }  

       echo "success";
    }else {
        echo "failed";
    }
?>