<?php

include_once("dbconnect.php");
// $user_email = $_POST['email'];
$type = $_GET['type'];

if($type=='CupCake'){
    
    $sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'CupCake' ORDER BY product_no DESC";
    
}else if($type=='BentoCake'){
    
    $sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'BentoCake' ORDER BY product_no DESC";
    
}else if($type=='Puff'){
    
    $sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'Puff' ORDER BY product_no DESC";
    
}else if($type=='Tart'){
    
    $sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'Tart' ORDER BY product_no DESC";
    
}else{
    $sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'BentoCake' ORDER BY product_no DESC";
}

$result = $con->query($sqlloadproduct);

if ($result->num_rows > 0){
    $response["product"] = array();
    while ($row = $result -> fetch_assoc()){
        $productlist = array();
        $productlist[product_no] = $row['product_no'];
        $productlist[product_name] = $row['product_name'];
        $productlist[original_price] = $row['original_price'];
        $productlist[offered_price] = $row['offered_price'];
        $productlist[rating] = $row['rating'];
        $productlist[product_detail] = $row['product_detail'];
        $productlist[type] = $row['type'];
        array_push($response["product"],$productlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}


?>