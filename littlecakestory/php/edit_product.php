<?php

include_once("dbconnect.php");

$product_no  = $_POST['product_no'];
$name = $_POST['name'];
$original_price = $_POST['original_price'];
$offered_price = $_POST['offered_price'];
$rating = $_POST['rating'];
$product_detail = $_POST['detail'];

$sql = "SELECT * FROM tbl_product WHERE product_no = '$product_no'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_product SET product_name = '$name', original_price = '$original_price', offered_price = '$offered_price', rating = '$rating', product_detail = '$product_detail' WHERE product_no = '$product_no'";
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