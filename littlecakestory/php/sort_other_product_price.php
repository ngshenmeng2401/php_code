<?php

include_once("dbconnect.php");

$user_email = $_POST['email'];
$sort_value = $_POST['sort_value'];
$type = $_POST['type'];

if($sort_value==2){
    if($type=='BentoCake'){
        $sqlloadbentocake= "SELECT * FROM tbl_product type = 'BentoCake' ORDER BY original_price ASC";
        
    }else if($type=='CupCake'){
        $sqlloadbentocake= "SELECT * FROM tbl_product type = 'CupCake' ORDER BY original_price ASC";
        
    }else if($type=='Puff'){
        $sqlloadbentocake= "SELECT * FROM tbl_product type = 'Puff' ORDER BY original_price ASC";
        
    }else if($type=='Tart'){
        $sqlloadbentocake= "SELECT * FROM tbl_product type = 'Tart' ORDER BY original_price ASC";
        
    }
    
}else if($sort_value==3){
    
    if($type=='BentoCake'){
        $sqlloadbentocake= "SELECT * FROM tbl_product WHERE type = 'BentoCake' ORDER BY original_price DESC";
        
    }else if($type=='CupCake'){
        $sqlloadbentocake= "SELECT * FROM tbl_product WHERE type = 'CupCake' ORDER BY original_price DESC";
        
    }else if($type=='Puff'){
        $sqlloadbentocake= "SELECT * FROM tbl_product WHERE type = 'Puff' ORDER BY original_price DESC";
        
    }else if($type=='Tart'){
        $sqlloadbentocake= "SELECT * FROM tbl_product WHERE type = 'Tart' ORDER BY original_price DESC";
        
    }
    
}

$result = $con->query($sqlloadbentocake);

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
        array_push($response["product"],$productlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>