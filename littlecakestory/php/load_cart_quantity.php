<?php
error_reporting(0);
include_once ("dbconnect.php");
$email = $_POST['email'];

$sql = "SELECT * FROM tbl_cart WHERE user_email = '$email'";    
$quantity = 0;
 
$result = $con->query($sql);

if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
      $quantity = $quantity + $row["product_qty"];
    }
    echo  $quantity;
}
else
{
    echo "nodata";
}
?>