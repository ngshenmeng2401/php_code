<?php

include_once("dbconnect.php");
$email = $_POST['email'];
$chatroomId = $_POST['chatroomId'];

$sqlselect= "SELECT * FROM tbl_participants WHERE email = '$email' AND chatroom_id = '$chatroomId'";
    $result1 = $con->query($sqlselect);
    if ($result1->num_rows > 0){
        
        $sqlupdate = "UPDATE tbl_participants SET unread_messages = '0' WHERE email = '$email' AND chatroom_id = '$chatroomId'";
        
        if ($con->query($sqlupdate) === TRUE){
            
            
        }
    }


$sqlloadchat = "SELECT c.chat_id, c.email as senderEmail, c.message, c.seen, c.date_sent, u.phone_no
FROM tbl_chat c
JOIN tbl_user u
ON u.email= c.email 
WHERE chatroom_id = '$chatroomId'
ORDER BY chat_id ASC";

$result = $con->query($sqlloadchat);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $chatlist = array();
        $chatlist[chat_id] = $row['chat_id'];
        $chatlist[senderEmail] = $row['senderEmail'];
        $chatlist[message] = $row['message'];
        $chatlist[seen] = $row['seen'];
        $chatlist[date_sent] = $row['date_sent'];
        $chatlist[phone_no] = $row['phone_no'];
        array_push($response,$chatlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}
?>