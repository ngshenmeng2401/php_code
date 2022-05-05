<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$rq1 = $_POST['rq1'];
$rq2 = $_POST['rq2'];
$rq3 = $_POST['rq3'];
$rq4 = $_POST['rq4'];
$notFound = false;

$sqlsearch = "SELECT * FROM tbl_eng_rq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqlupdate = "UPDATE tbl_eng_rq SET rq1 = '$rq1', rq2 = '$rq2', rq3 = '$rq3', rq4 = '$rq4' WHERE student_id = '$student_id'";
    
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