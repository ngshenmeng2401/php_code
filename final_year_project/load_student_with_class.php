<?php

include_once("dbconnect.php");
$className = $_POST['className'];

$sqlloadstudent= "SELECT * FROM tbl_student WHERE class = '$className' ORDER BY id ASC";

$result = $con->query($sqlloadstudent);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $studentlist = array();
        $studentlist[id] = $row['id'];
        $studentlist[name] = $row['name'];
        $studentlist[studentClass] = $row['class'];
        $studentlist[age] = $row['age'];
        $studentlist[parent_id] = $row['parent_id'];
        $studentlist[phone_no] = $row['phone_no'];
        array_push($response,$studentlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>