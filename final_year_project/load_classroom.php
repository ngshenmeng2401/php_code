<?php

include_once("dbconnect.php");
$name = $_POST['name'];
$action = $_POST['action'];
$sortValue = $_POST['sortValue'];

if( isset($name) AND $action == "search"){
    
    $sqlloadstudent= "SELECT * FROM tbl_student WHERE name LIKE '%$name%' ORDER BY id ASC";

}else if($action == "sort" AND $sortValue=="idD"){
    
    $sqlloadstudent= "SELECT * FROM tbl_student ORDER BY id DESC";
    
}else if($action == "sort" AND $sortValue=="nameA"){
    
    $sqlloadstudent= "SELECT * FROM tbl_student ORDER BY name ASC";
    
}else if($action == "sort" AND $sortValue=="nameD"){
    
    $sqlloadstudent= "SELECT * FROM tbl_student ORDER BY name DESC";
    
}else {
    $sqlloadstudent= "SELECT * FROM tbl_student ORDER BY id ASC";
    
}

$sqlloadclasroom= "SELECT * FROM tbl_classroom ORDER BY class_id ASC";

$result = $con->query($sqlloadclasroom);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $classroomlist = array();
        $classroomlist[class_id] = $row['class_id'];
        $classroomlist[class_name] = $row['class_name'];
        $classroomlist[students] = $row['students'];
        $classroomlist[age] = $row['age'];
        array_push($response,$classroomlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>