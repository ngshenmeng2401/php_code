<?php
$servername = "localhost";
$username = "javathre_mystrackeradmin";
$password = "7z@Xo~)0oGEN";
$dbname = "javathre_mystrackerdb";

$con = new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
?>