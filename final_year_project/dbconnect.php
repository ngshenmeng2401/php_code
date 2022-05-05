<?php
$servername = "localhost";
$username = "javathre_tasneemchildrenperformanceadmin";
$password = "D~;}7%2X#jK4";
$dbname = "javathre_tasneemchildrenperformancedb";

$con = new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
?>