<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$wq1 = $_POST['wq1'];
$wq2 = $_POST['wq2'];
$notFound = false;

$sqlsearch = "SELECT * FROM tbl_eng_wq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqlupdate = "UPDATE tbl_eng_wq SET wq1 = '$wq1', wq2 = '$wq2' WHERE student_id = '$student_id'";
    
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