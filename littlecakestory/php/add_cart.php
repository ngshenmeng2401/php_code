<?php
error_reporting(0);
include_once("dbconnect.php");

$product_no = $_POST['product_no'];
$product_price = $_POST['product_price'];
$user_qty = $_POST['user_qty'];
$email = $_POST['email'];
$product_size = $_POST['product_size'];
$eggLess = $_POST['eggLess'];
$message = $_POST['message'];

$sqlsearch = "SELECT * FROM tbl_cart WHERE user_email = '$email' AND product_no = '$product_no' AND product_price = '$product_price'";

$result = $con->query($sqlsearch);
if ($result->num_rows > 0) {
    while ($row = $result ->fetch_assoc()){
        $prquantity = $row["product_qty"];
    }
    $prquantity = $prquantity + $user_qty;
    $sqlinsert = "UPDATE tbl_cart SET product_qty = '$prquantity' WHERE user_email = '$email' AND product_no = '$product_no' AND product_price = '$product_price'";
    
}else{
    $sqlinsert = "INSERT INTO tbl_cart(user_email,product_no,product_qty,product_price,product_size,eggless,message) VALUES ('$email','$product_no','$user_qty','$product_price','$product_size','$eggLess','$message')";
}

if ($con->query($sqlinsert) === true)
{
    $sqlquantity = "SELECT * FROM tbl_cart WHERE user_email = '$email'";

    $resultq = $con->query($sqlquantity);
    if ($resultq->num_rows > 0) {
        $quantity = 0;
        while ($row = $resultq ->fetch_assoc()){
            $quantity = $row["product_qty"] + $quantity;
        }
    }

    $quantity = $quantity;
    echo "success,".$quantity;
}
else
{
    echo "failed";
}


?>