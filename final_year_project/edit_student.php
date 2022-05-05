<?php

include_once("dbconnect.php");

$id = $_POST['id'];
$oldValue = $_POST['oldValue'];
$newValue = $_POST['newValue'];
$category = $_POST['category'];

$sqleditstudent = "SELECT * FROM tbl_student WHERE id = '$id'";
    $result = $con->query($sqleditstudent);
    if ($result->num_rows > 0) {
        
        if($category == "name"){
            
            $sqlupdate = "UPDATE tbl_student SET name = '$newValue' WHERE id = '$id'";
    
        }else if($category == "class"){
            
            $sqlsearch1 = "SELECT * FROM tbl_classroom WHERE class_name = '$newValue'";
            $result1 = $con->query($sqlsearch1);
            if ($result1->num_rows > 0){
                
                $sqlupdateclassroom1 = "UPDATE tbl_classroom SET students=students+1 WHERE class_name = '$newValue'";
                
            }
            
            $sqlsearch2 = "SELECT * FROM tbl_classroom WHERE class_name = '$oldValue'";
            $result2 = $con->query($sqlsearch2);
            if ($result2->num_rows > 0){
                
                $sqlupdateclassroom2 = "UPDATE tbl_classroom SET students=students-1 WHERE class_name = '$oldValue'";
            }
            
            $sqlupdate = "UPDATE tbl_student SET class = '$newValue' WHERE id = '$id'";
            
        }else if($category == "age"){
            
            $sqlupdate = "UPDATE tbl_student SET age = '$newValue' WHERE id = '$id'";
            
        }else if($category == "parentid"){
            
            $sqlupdate = "UPDATE tbl_student SET parent_id = '$newValue' WHERE id = '$id'";
            
        }else if($category == "phoneno"){
            
            $sqlupdate = "UPDATE tbl_student SET phone_no = '$newValue' WHERE id = '$id'";
            
        }
        
        if ($con->query($sqlupdate) === TRUE and $con->query($sqlupdateclassroom1) === TRUE and $con->query($sqlupdateclassroom2) === TRUE){
            
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    else{
        echo "failed";
    }
    
?>