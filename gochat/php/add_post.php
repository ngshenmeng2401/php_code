<?php

include_once("dbconnect.php");
$encoded_string = $_POST["encoded_string"];
$email= $_POST['email'];
$content= $_POST['content'];
$type= $_POST['type'];
$likes = 0;

if($type == "withPic"){
    $imgStatus = "yes";
    
}else if($type == "withoutPic"){
    $imgStatus = "noimage";
}


$sqlinsert = "INSERT INTO tbl_post(email,content,likes,img_status) VALUES('$email','$content','$likes','$imgStatus')";
if ($con->query($sqlinsert) === TRUE){
    
    if($type == "withPic"){
        
        $decoded_string = base64_decode($encoded_string);
        $filename = mysqli_insert_id($con);
        $path = '../images/post/'.$filename.'.png';
        $is_written = file_put_contents($path, $decoded_string);
    }
    echo "success";
}else{
    echo "failed";
}

?>