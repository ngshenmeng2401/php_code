<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$lq1 = $_POST['lq1'];
$lq2 = $_POST['lq2'];
$lq3 = $_POST['lq3'];
$lq4 = $_POST['lq4'];
$duplicate = false;

$sqlsearch = "SELECT * FROM tbl_eng_lq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $duplicate = true;
    
}else{
    $sqlinsert = "INSERT INTO tbl_eng_lq(student_id,lq1,lq2,lq3,lq4) VALUES ('$student_id','$lq1','$lq2','$lq3','$lq4')";
}
    
if($con->query($sqlinsert) === TRUE){
    
    echo "Success";
}else if($duplicate == true){
    
    echo "Duplicate";
    
}else{
    echo "Failed";
    
}

?>