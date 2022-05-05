<?php
include_once("dbconnect.php");

$student_id = $_POST['studentId'];
$category = $_POST['category'];
$notFound = false;

if($category == "listening"){
    
    $sqlsearch = "SELECT * FROM tbl_eng_lq WHERE student_id = '$student_id'";
    $result = $con->query($sqlsearch);
    if ($result->num_rows > 0){
        
        $sqldelete = "DELETE FROM tbl_eng_lq WHERE student_id = '$student_id'";
        
    }else{
        $notFound = true;
    }
    
}else if($category == "reading"){
    
    $sqlsearch = "SELECT * FROM tbl_eng_rq WHERE student_id = '$student_id'";
    $result = $con->query($sqlsearch);
    if ($result->num_rows > 0){
        
        $sqldelete = "DELETE FROM tbl_eng_rq WHERE student_id = '$student_id'";
        
    }else{
        $notFound = true;
    }
    
}else if($category == "speaking"){
    
    $sqlsearch = "SELECT * FROM tbl_eng_sq WHERE student_id = '$student_id'";
    $result = $con->query($sqlsearch);
    if ($result->num_rows > 0){
        
        $sqldelete = "DELETE FROM tbl_eng_sq WHERE student_id = '$student_id'";
        
    }else{
        $notFound = true;
    }
    
}else if($category == "writing"){
    
    $sqlsearch = "SELECT * FROM tbl_eng_wq WHERE student_id = '$student_id'";
    $result = $con->query($sqlsearch);
    if ($result->num_rows > 0){
        
        $sqldelete = "DELETE FROM tbl_eng_wq WHERE student_id = '$student_id'";
        
    }else{
        $notFound = true;
    }
    
}
    
if($con->query($sqldelete) === TRUE){
    
    echo "Success";
}else if($notFound == true){
    
    echo "NotFound";
    
}else{
    echo "Failed";
    
}
?>