<?php

include_once("dbconnect.php");
$className = $_POST['className'];
$name = $_POST['name'];
$action = $_POST['action'];
$sortValue = $_POST['sortValue'];

if( isset($name) AND $action == "search"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.lq_id, b.lq1, b.lq2, b.lq3, b.lq4
    FROM tbl_student a  
    JOIN tbl_eng_lq b
    ON b.student_id = a.id
    WHERE name LIKE '%$name%' AND class = '$className'
    ORDER BY id ASC";

}else if($action == "sort" AND $sortValue=="idD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.lq_id, b.lq1, b.lq2, b.lq3, b.lq4
    FROM tbl_student a  
    JOIN tbl_eng_lq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY id DESC";
    
}else if($action == "sort" AND $sortValue=="nameA"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.lq_id, b.lq1, b.lq2, b.lq3, b.lq4
    FROM tbl_student a  
    JOIN tbl_eng_lq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name ASC";
    
}else if($action == "sort" AND $sortValue=="nameD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.lq_id, b.lq1, b.lq2, b.lq3, b.lq4
    FROM tbl_student a  
    JOIN tbl_eng_lq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name DESC";
    
}else {
    $sqlloadrecord = "SELECT a.id, a.name, b.lq_id, b.lq1, b.lq2, b.lq3, b.lq4
    FROM tbl_student a  
    JOIN tbl_eng_lq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY id ASC";
    
}

$result = $con->query($sqlloadrecord);

if ($result->num_rows > 0){
    $response = array();
    while ($row = $result -> fetch_assoc()){
        $recordlist = array();
        $recordlist[id] = $row['id'];
        $recordlist[name] = $row['name'];
        $recordlist[lq_id] = $row['lq_id'];
        $recordlist[lq1] = $row['lq1'];
        $recordlist[lq2] = $row['lq2'];
        $recordlist[lq3] = $row['lq3'];
        $recordlist[lq4] = $row['lq4'];
        array_push($response,$recordlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>