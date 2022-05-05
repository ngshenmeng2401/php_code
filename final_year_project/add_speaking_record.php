<?php

include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$sq1 = $_POST['sq1'];
$sq2 = $_POST['sq2'];
$sq3 = $_POST['sq3'];
$sq4 = $_POST['sq4'];
$sq5 = $_POST['sq5'];
$duplicate = false;

$sqlsearch = "SELECT * FROM tbl_eng_sq WHERE student_id = '$student_id'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $duplicate = true;
    
}else{
    $sqlinsert = "INSERT INTO tbl_eng_sq(student_id,sq1,sq2,sq3,sq4,sq5) VALUES ('$student_id','$sq1','$sq2','$sq3','$sq4','$sq5')";
}
    
if($con->query($sqlinsert) === TRUE){
    
    echo "Success";
}else if($duplicate == true){
    
    echo "Duplicate";
    
}else{
    echo "Failed";
    
}

?>