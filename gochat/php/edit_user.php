<?php

include_once("dbconnect.php");

$email = $_POST['email'];
$username = $_POST['username'];
$newPhoneNo = $_POST['newPhoneNo'];
$oldPhoneNo = $_POST['oldPhoneNo'];

$sqledituser = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = $con->query($sqledituser);
    if ($result->num_rows > 0) {
        
        
        if($newPhoneNo == "phoneNo"){
            
            $sqlupdate = "UPDATE tbl_user SET username='$username' WHERE email = '$email'";
            
        }else if($username == "username"){
            
            $oldname = "../images/user_profile/".$oldPhoneNo.".png";
            $newname = "../images/user_profile/".$newPhoneNo.".png";
            
            if(!rename($oldname, $newname)){
                
                echo "File can't be renamed";
                
            }else{
                
                echo 'success';
                
            }
            
            $sqlupdate = "UPDATE tbl_user SET phone_no = '$newPhoneNo' WHERE email = '$email'";
            
        }
    }
        
    if ($con->query($sqlupdate) === TRUE){
        echo 'success';
    }else{
        echo 'failed';
    }
    
?>