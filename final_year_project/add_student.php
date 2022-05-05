<?php

include_once("dbconnect.php");

$name = $_POST['name'];
$studentClass = $_POST['studentClass'];
$age = $_POST['age'];
$parentId = $_POST['parentId'];
$phoneNo = $_POST['phoneNo'];

$sqlsearch = "SELECT * FROM tbl_classroom WHERE class_name = '$studentClass' AND age = '$age'";
$result = $con->query($sqlsearch);
if ($result->num_rows > 0){
    
    $sqlinsert = "UPDATE tbl_classroom SET students=students+1 WHERE class_name = '$studentClass' AND age = '$age'";
    
}else{
    $sqlinsert = "INSERT INTO tbl_classroom(class_name,age,students) VALUES ('$studentClass','$age','1')";
}
    
$sqladdstudent="INSERT INTO tbl_student(name,class,age,parent_id,phone_no) VALUES ('$name','$studentClass','$age','$parentId','$phoneNo')";
if($con->query($sqladdstudent) === TRUE and $con->query($sqlinsert) === TRUE){
    
    echo "Success";
}else{
    echo "Failed";
    
}

?>