<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$rq1 = $_POST['rq1'];
$rq2 = $_POST['rq2'];
$rq3 = $_POST['rq3'];
$rq4 = $_POST['rq4'];
$duplicate = false;

$sqlsearch = "SELECT * FROM tbl_eng_rq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $duplicate = true;
    
}else{
    $sqlinsert = "INSERT INTO tbl_eng_rq(student_id,rq1,rq2,rq3,rq4) VALUES ('$student_id','$rq1','$rq2','$rq3','$rq4')";
}
    
if($con->query($sqlinsert) === TRUE){
    
    echo "Success";
}else if($duplicate == true){
    
    echo "Duplicate";
    
}else{
    echo "Failed";
    
}

?>