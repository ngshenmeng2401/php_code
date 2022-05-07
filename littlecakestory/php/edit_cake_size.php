<?php

include_once("dbconnect.php");

$product_no = $_POST['product_no'];
$selected_slice = $_POST['selected_slice'];
$selected_6_inch = $_POST['6_inch'];
$selected_8_inch = $_POST['8_inch'];
$selected_10_inch = $_POST['10_inch'];

$sql = "SELECT * FROM tbl_product WHERE product_no = '$product_no'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_product SET slice = '$selected_slice',6_inch = '$selected_6_inch', 8_inch = '$selected_8_inch', 10_inch = '$selected_10_inch' WHERE product_no = '$product_no'";
        if ($con->query($sqlupdate) === TRUE){
                    echo 'success';
            }else{
                    echo 'failed';
            }
    }
    else{
        echo "failed";
    }
    
?>