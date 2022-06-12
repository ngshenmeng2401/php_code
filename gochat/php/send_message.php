<?php

include_once("dbconnect.php");
$email = $_POST['email'];
$friendEmail = $_POST['friendEmail'];
$messageText = $_POST['messageText'];
$mute = "false";
$seen = "false";

$sqlloadparticipant1 = "SELECT * FROM tbl_participants WHERE email = '$email'";

$sqlloadparticipant2 = "SELECT * FROM tbl_participants WHERE email = '$friendEmail'";

$result1 = $con->query($sqlloadparticipant1);
$result2 = $con->query($sqlloadparticipant2);

if ($result1->num_rows > 0) {
    
    if ($result2->num_rows > 0){
        
        while ($row1 = $result1 -> fetch_assoc()){
            $chatroomId1 = $row1["chatroom_id"];
            
            while ($row2 = $result2 -> fetch_assoc()){
                $chatroomId2 = $row2["chatroom_id"];
                
                if($chatroomId1 == $chatroomId2){
                    
                    $chatroomIdResult = $chatroomId1 = $chatroomId2;
                    
                    $sqladdchatrecord = "INSERT INTO tbl_chat(email,message,seen,chatroom_id) VALUES('$email','$messageText','$seen','$chatroomIdResult')";
                    
                    $sqlupdateparticipant = "UPDATE tbl_participants SET unread_messages = unread_messages+1 WHERE email = '$friendEmail' AND chatroom_id = '$chatroomIdResult'";
                }
                
            }
            
        }
    }
    
    if ($con->query($sqlupdateparticipant) === TRUE and $con->query($sqladdchatrecord) === TRUE){
    
        echo "success";
    }else{
        echo "failed";
    }
    
}else{
    
    $sqladdchatroom = "INSERT INTO tbl_chatroom(name) VALUES('Private Chat')";

    if ($con->query($sqladdchatroom) === TRUE){
        
        $lastId =   mysqli_insert_id($con);
    }
    
    $sqladdparticipants1 = "INSERT INTO tbl_participants(email,unread_messages,mute,chatroom_id) VALUES('$email','0','$mute','$lastId')";
    $sqladdparticipants2 = "INSERT INTO tbl_participants(email,unread_messages,mute,chatroom_id) VALUES('$friendEmail','1','$mute','$lastId')";
    
    $sqladdchatrecord = "INSERT INTO tbl_chat(email,message,seen,chatroom_id) VALUES('$email','$messageText','$seen','$lastId')";
    
    if ($con->query($sqladdparticipants1) === TRUE and $con->query($sqladdparticipants2) === TRUE and $con->query($sqladdchatrecord) === TRUE){
    
        echo "success";
    }else{
        echo "failed";
    }
}

?>