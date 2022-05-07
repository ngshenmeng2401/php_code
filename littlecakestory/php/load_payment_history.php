<?php

include_once("dbconnect.php");
$user_email = $_POST['email'];

$sqlloadpaymenthistory= "SELECT * FROM tbl_payment WHERE user_email = '$user_email' ORDER BY date_time DESC";
$result = $con->query($sqlloadpaymenthistory);

if ($result->num_rows > 0){
    $response["payment_history"] = array();
    while ($row = $result -> fetch_assoc()){
        $historylist = array();
        $historylist[payment_id] = $row['payment_id'];
        $historylist[item] = $row['item'];
        $historylist[total_payment] = $row['total_payment'];
        $historylist[payment_method] = $row['payment_method'];
        $historylist[date_time] = $row['date_time'];
        array_push($response["payment_history"],$historylist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>