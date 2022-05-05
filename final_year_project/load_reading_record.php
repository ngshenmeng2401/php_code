<?php

include_once("dbconnect.php");
$className = $_POST['className'];
$name = $_POST['name'];
$action = $_POST['action'];
$sortValue = $_POST['sortValue'];

if( isset($name) AND $action == "search"){
    

    $sqlloadrecord = "SELECT a.id, a.name, b.rq_id, b.rq1, b.rq2, b.rq3, b.rq4
    FROM tbl_student a  
    JOIN tbl_eng_rq b
    ON b.student_id = a.id
    WHERE name LIKE '%$name%' AND class = '$className'
    ORDER BY id ASC";

}else if($action == "sort" AND $sortValue=="idD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.rq_id, b.rq1, b.rq2, b.rq3, b.rq4
    FROM tbl_student a  
    JOIN tbl_eng_rq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY id DESC";
    
}else if($action == "sort" AND $sortValue=="nameA"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.rq_id, b.rq1, b.rq2, b.rq3, b.rq4
    FROM tbl_student a  
    JOIN tbl_eng_rq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name ASC";
    
}else if($action == "sort" AND $sortValue=="nameD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.rq_id, b.rq1, b.rq2, b.rq3, b.rq4
    FROM tbl_student a  
    JOIN tbl_eng_rq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name DESC";
    
}else {
    $sqlloadrecord = "SELECT a.id, a.name, b.rq_id, b.rq1, b.rq2, b.rq3, b.rq4
    FROM tbl_student a  
    JOIN tbl_eng_rq b
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
        $recordlist[rq1] = $row['rq1'];
        $recordlist[rq2] = $row['rq2'];
        $recordlist[rq3] = $row['rq3'];
        $recordlist[rq4] = $row['rq4'];
        array_push($response,$recordlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>