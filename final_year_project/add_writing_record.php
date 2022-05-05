<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$wq1 = $_POST['wq1'];
$wq2 = $_POST['wq2'];
$duplicate = false;

$sqlsearch = "SELECT * FROM tbl_eng_wq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $duplicate = true;
    
}else{
    $sqlinsert = "INSERT INTO tbl_eng_wq(student_id,wq1,wq2) VALUES ('$student_id','$wq1','$wq2')";
}
    
if($con->query($sqlinsert) === TRUE){
    
    echo "Success";
}else if($duplicate == true){
    
    echo "Duplicate";
    
}else{
    echo "Failed";
    
}

?>