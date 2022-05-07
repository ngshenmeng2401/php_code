<?php
error_reporting(0);
include_once("dbconnect.php");

$email = $_GET['email']; //email
$phoneNo = $_GET['phoneNo']; 
$name = $_GET['name']; 
$totalPayment = $_GET['totalPayment']; 
$dateTime = $_GET['dateTime']; 
$message = $_GET['message']; 
$address = $_GET['address']; 
$item_qty = $_GET['item_qty']; 

// echo $email;
// echo $phoneNo;
// echo $name;
// echo $totalPayment;
// echo $dateTime;
// echo $message;
// echo $address;
// echo $item_qty;

$api_key = '4418812d-7f79-4707-afdb-8b9e213b9f1f';
$collection_id = 'dvdnzrty';
$host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

$data = array(
    'collection_id' => $collection_id,
    'email' => $email,
    'mobile' => $phoneNo,
    'name' => $name,
    'amount' => $totalPayment * 100, // RM20
    'description' => 'Payment for order' ,
    'callback_url' => "https://javathree99.com/s271059/littlecakestory/php/return_url",
    'redirect_url' => "https://javathree99.com/s271059/littlecakestory/php/update_payment.php?email=$email&phoneNo=$phoneNo&name=$name&totalPayment=$totalPayment&dateTime=$dateTime&message=$message&address=$address&item_qty=$item_qty" 
);


$process = curl_init($host );
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data) ); 

$return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);

echo "<pre>".print_r($bill, true)."</pre>";
header("Location: {$bill['url']}");
?>