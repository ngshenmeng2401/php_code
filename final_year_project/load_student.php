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