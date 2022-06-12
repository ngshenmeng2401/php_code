<?php

include_once("dbconnect.php");
$email = $_GET['email'];

$sqlloadchatroom = "SELECT cr.chatroom_id as chatRoomId, f.email as senderEmail, p.email as receiverEmail, p.unread_messages, u.username, u.phone_no, u.img_status
FROM tbl_participants p
JOIN tbl_friend f 
ON f.friend_email = p.email 
JOIN tbl_user u
ON u.email = p.email
JOIN tbl_chatroom cr
ON cr.chatroom_id = p.chatroom_id
WHERE f.email = '$email' ";

$result = $con->query($sqlloadchatroom);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $chatroomlist = array();
        $chatroomlist[chatRoomId] = $row['chatRoomId'];
        $chatroomlist[senderEmail] = $row['senderEmail'];
        $chatroomlist[receiverEmail] = $row['receiverEmail'];
        $chatroomlist[unread_messages] = $row['unread_messages'];
        // $chatroomlist[message] = $row['message'];
        $chatroomlist[username] = $row['username'];
        $chatroomlist[phone_no] = $row['phone_no'];
        $chatroomlist[img_status] = $row['img_status'];
        array_push($response,$chatroomlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>