<?php

include_once("dbconnect.php");

$email = $_POST['email'];
$username = $_POST['username'];
$newPhoneNo = $_POST['newPhoneNo'];
$old_Phone_No = $_POST['oldPhoneNo'];

$sqledituser = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = $con->query($sqledituser);
    if ($result->num_rows > 0) {
        
        while ($row = $result -> fetch_assoc()){
             
        if($old_Phone_No == $row['phone_no'] && $username == $row['username']){
            
            $oldname = "../images/user_profile/".$old_Phone_No.".png";
            $newname = "../images/user_profile/".$newPhoneNo.".png";
            
            if(!rename($oldname, $newname)){
                
                echo "File can't be renamed";
                
            }else{
                
                echo 'success';
                
            }
            
            $sqlupdate = "UPDATE tbl_user SET phone_no = '$newPhoneNo',username='$username',phone_no='$newPhoneNo' WHERE email = '$email'";
            
        }
        
        if ($con->query($sqlupdate) === TRUE){
            echo 'success';
        }else{
            echo 'failed';
        }
         }
    }
    else{
        echo "failed";
    }
    
?>