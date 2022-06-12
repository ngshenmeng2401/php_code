<?php

include_once("dbconnect.php");
$email = $_POST['email'];
$friendEmail = $_POST['friendEmail'];

$sqlloadchat1 = "SELECT * FROM tbl_chat WHERE email = '$email'";

$sqlloadchat2 = "SELECT * FROM tbl_chat WHERE email = '$friendEmail'";

$result1 = $con->query($sqlloadchat1);
$result2 = $con->query($sqlloadchat2);

if ($result1->num_rows > 0) {
    
    if ($result2->num_rows > 0){
        
        while ($row1 = $result1 -> fetch_assoc()){
            $chatroomId1 = $row1["chatroom_id"];
            
            while ($row2 = $result2 -> fetch_assoc()){
                
                $chatroomId2 = $row2["chatroom_id"];
                
                if($chatroomId1 == $chatroomId2){
                    
                    $chatroomIdResult = $chatroomId1 = $chatroomId2;
                    
                    $sqlloadchat = "SELECT c.chat_id, c.email as senderEmail, c.message, c.seen, c.date_sent, u.phone_no
                    FROM tbl_chat c
                    JOIN tbl_user u
                    ON u.email= c.email 
                    WHERE chatroom_id = '$chatroomIdResult'
                    ORDER BY chat_id DESC";
                }
            }
        }
    }
}

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