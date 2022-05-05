<?php
error_reporting(0);
include_once("dbconnect.php");
$id = $_POST['id'];
$age = $_POST['age'];
$studentClass = $_POST['classRoom'];

$sqlsearch = "SELECT * FROM tbl_classroom WHERE class_name = '$studentClass' AND age = '$age'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqldeletestudent = "UPDATE tbl_classroom SET students=students-1 WHERE class_name = '$studentClass' AND age = '$age'";
    
}

$sqldelete = "DELETE FROM tbl_student WHERE id = '$id'";
    if ($con->query($sqldelete) === TRUE and $con->query($sqldeletestudent) === TRUE){
       echo "success";
    }else {
        echo "failed";
    }
?>