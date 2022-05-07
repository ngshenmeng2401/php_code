<?php
error_reporting(0);
include_once ("dbconnect.php");
$email = $_POST['email'];

if (isset($email)){
     $sql = "SELECT tbl_product.product_no, tbl_product.product_name, tbl_product.rating, tbl_cart.product_size, tbl_cart.eggless, tbl_cart.product_qty, tbl_cart.product_price FROM tbl_product INNER JOIN tbl_cart ON tbl_cart.product_no = tbl_product.product_no WHERE tbl_cart.user_email = '$email'";
}


$result = $con->query($sql);

if ($result->num_rows > 0)
{
    $response["cart"] = array();
    while ($row = $result->fetch_assoc())
    {
        $cartlist = array();
        $cartlist["product_no"] = $row["product_no"];
        $cartlist["product_name"] = $row["product_name"];
        $cartlist["product_price"] = $row["product_price"];
        $cartlist["rating"] = $row["rating"];
        $cartlist["product_qty"] = $row["product_qty"];
        $cartlist["product_size"] = $row["product_size"];
        $cartlist["eggless"] = $row["eggless"];
        
        $cartlist["total_price"] = round(doubleval($row["product_price"])*(doubleval($row["product_qty"])),2)."";
        
        array_push($response["cart"], $cartlist);
    }
    echo json_encode($response);
}
else
{
    echo "Cart Empty";
}

?>