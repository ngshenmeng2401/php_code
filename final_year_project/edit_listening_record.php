<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$lq1 = $_POST['lq1'];
$lq2 = $_POST['lq2'];
$lq3 = $_POST['lq3'];
$lq4 = $_POST['lq4'];
$notFound = false;

$sqlsearch = "SELECT * FROM tbl_eng_lq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqlupdate = "UPDATE tbl_eng_lq SET lq1 = '$lq1', lq2 = '$lq2', lq3 = '$lq3', lq4 = '$lq4' WHERE student_id = '$student_id'";
    
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