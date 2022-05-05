<?php

include_once("dbconnect.php");
$className = $_POST['className'];
$name = $_POST['name'];
$action = $_POST['action'];
$sortValue = $_POST['sortValue'];

if( isset($name) AND $action == "search"){
    
    $sqlloadstudent= "SELECT * FROM tbl_student WHERE  ORDER BY id ASC";
    $sqlloadrecord = "SELECT a.id, a.name, b.sq_id, b.sq1, b.sq2, b.sq3, b.sq4, b.sq5
    FROM tbl_student a  
    JOIN tbl_eng_sq b
    ON b.student_id = a.id
    WHERE name LIKE '%$name%' AND class = '$className'
    ORDER BY id ASC";

}else if($action == "sort" AND $sortValue=="idD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.sq_id, b.sq1, b.sq2, b.sq3, b.sq4, b.sq5
    FROM tbl_student a  
    JOIN tbl_eng_sq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY id DESC";
    
}else if($action == "sort" AND $sortValue=="nameA"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.sq_id, b.sq1, b.sq2, b.sq3, b.sq4, b.sq5
    FROM tbl_student a  
    JOIN tbl_eng_sq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name ASC";
    
}else if($action == "sort" AND $sortValue=="nameD"){
    
    $sqlloadrecord = "SELECT a.id, a.name, b.sq_id, b.sq1, b.sq2, b.sq3, b.sq4, b.sq5
    FROM tbl_student a  
    JOIN tbl_eng_sq b
    ON b.student_id = a.id
    WHERE class = '$className'
    ORDER BY name DESC";
    
}else {
    $sqlloadrecord = "SELECT a.id, a.name, b.sq_id, b.sq1, b.sq2, b.sq3, b.sq4, b.sq5
    FROM tbl_student a  
    JOIN tbl_eng_sq b
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
        $recordlist[sq_id] = $row['sq_id'];
        $recordlist[sq1] = $row['sq1'];
        $recordlist[sq2] = $row['sq2'];
        $recordlist[sq3] = $row['sq3'];
        $recordlist[sq4] = $row['sq4'];
        $recordlist[sq5] = $row['sq5'];
        array_push($response,$recordlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>