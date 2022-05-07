<?php

include_once("dbconnect.php");

$addressno = $_POST['addressno'];
$streetAddress = $_POST['streetAddress'];
$postalCode = $_POST['postalCode'];
$city = $_POST['city'];
$state = $_POST["state"];

$sql = "SELECT * FROM tbl_user_address WHERE address_no = '$addressno'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_user_address SET street_address = '$streetAddress', postal_code = '$postalCode', city = '$city', state = '$state' WHERE address_no = '$addressno'";
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