<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/javathre/public_html/s271059/littlecakestory/php/PHPMailer/Exception.php';
require '/home8/javathre/public_html/s271059/littlecakestory/php/PHPMailer/PHPMailer.php';
require '/home8/javathre/public_html/s271059/littlecakestory/php/PHPMailer/SMTP.php';

include_once("dbconnect.php");

$user_email = $_POST['email'];
$newotp = rand(100000,999999);
$newpassword = $_POST['newpassword'];
$passha = sha1($newpassword);

$sql = "SELECT * FROM tbl_user WHERE user_email = '$user_email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_user SET otp = '$newotp', password = '$passha' WHERE user_email = '$user_email'";
        if ($con->query($sqlupdate) === TRUE){
                sendEmail($newotp,$user_email);
                echo 'success';
        }else{
                echo 'failed';
        }
    }else{
        echo "failed";
    }

    
function sendEmail($newotp,$user_email){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                           //Disable verbose debug output
    $mail->isSMTP();                                //Send using SMTP
    $mail->Host       = 'mail.javathree99.com';                         //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       //Enable SMTP authentication
    $mail->Username   = 'littlecakestory@javathree99.com';                         //SMTP username
    $mail->Password   = 'KACHI217uum';                         //SMTP password
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587;
    
    $from = "littlecakestory@javathree99.com";
    $to = $user_email;
    $subject = "From Little Cake Story. Please reset your password";
    $message = "<p>Your account password has been reset. Please login again using the information below.</p><br><br>
    <a href='https://javathree99.com/s271059/littlecakestory/php/vertify_account.php?email=".$user_email."&key=".$newotp."'>Click Here to reactivate your account</a>";
    
    $mail->setFrom($from,"Little Cake Story");
    $mail->addAddress($to);                                             //Add a recipient
    
    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
}
?>