<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$sq1 = $_POST['sq1'];
$sq2 = $_POST['sq2'];
$sq3 = $_POST['sq3'];
$sq4 = $_POST['sq4'];
$sq5 = $_POST['sq5'];
$notFound = false;

$sqlsearch = "SELECT * FROM tbl_eng_sq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqlupdate = "UPDATE tbl_eng_sq SET sq1 = '$sq1', sq2 = '$sq2', sq3 = '$sq3', sq4 = '$sq4', sq5 = '$sq5' WHERE student_id = '$student_id'";
    
}else{
    $notFound = true;
}
    
if($con->query($sqlupdate) === TRUE){
    
    echo "Success";
}else if($notFound == true){
    
    echo "NotFound";
    
}else{
    echo "Failed";
    
}

?>