<?php

include_once("dbconnect.php");
$user_email = $_POST['email'];

$sqlloadaddress= "SELECT * FROM tbl_user_address WHERE user_email = '$user_email' ORDER BY address_no ASC";
$result = $con->query($sqlloadaddress);

if ($result->num_rows > 0){
    $response["address"] = array();
    while ($row = $result -> fetch_assoc()){
        $addresslist = array();
        $addresslist[address_no] = $row['address_no'];
        $addresslist[place] = $row['place'];
        $addresslist[street_address] = $row['street_address'];
        $addresslist[postal_code] = $row['postal_code'];
        $addresslist[city] = $row['city'];
        $addresslist[state] = $row['state'];
        array_push($response["address"],$addresslist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>