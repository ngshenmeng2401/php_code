<?php

include_once("dbconnect.php");

$sqlloadproduct= "SELECT * FROM tbl_product WHERE type = 'Cake' ORDER BY product_no DESC";

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
        $productlist[slice] = $row['slice'];
        $productlist[size6_inch] = $row['6_inch'];
        $productlist[size8_inch] = $row['8_inch'];
        $productlist[size10_inch] = $row['10_inch'];
        $productlist[type] = $row['type'];
        array_push($response["product"],$productlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>