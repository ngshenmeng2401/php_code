<?php
$servername = "localhost";
$username = "javathre_gochatadmin";
$password = "KG]S#1Z8;+Qz";
$dbname = "javathre_gochatdb";

$con = new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
?>