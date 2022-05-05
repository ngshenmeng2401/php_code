<?php
session_start();
include("dbconnect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/Exception.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/PHPMailer.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/SMTP.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    
    $sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' AND position = '$position' AND otp = '0'";

    $result = $con->query($sqllogin);
    
    if ($result->num_rows > 0) {
        
        $_SESSION["session_id"] = session_id();
        $_SESSION["email"] = $email;
        
        echo "<script> alert('Login successful')</script>";
            
        if($position == "admin"){
            echo "<script> window.location.replace('admin/dashboard.php')</script>";
        }else{
            echo "<script> window.location.replace('user/manage_document.php')</script>";
        }
        
    } else {
        session_unset();
        session_destroy();
        echo "<script> alert('Login fail')</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
    
}else if (isset($_POST['forget_password'])){
    
    $email = $_POST["email"];
    $newpassword = password_generate(8);
    $newotp = rand(100000,999999);

    $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $sqlupdate = "UPDATE tbl_user SET password = '$newpassword', otp = '$newotp' WHERE email = '$email'";
            if ($con->query($sqlupdate) === TRUE){
                    sendEmail($newotp,$email,$newpassword);
                    echo "<script type='text/javascript'>alert('Please check your email');</script>'";
            }else{
                    echo "<script type='text/javascript'>alert('Failed!!');</script>'";
            }
        }
    
    }

if (isset($_GET["status"])) {
    if (($_GET["status"] == "logout")) {
        session_unset();
        session_destroy();
        echo "<script> alert('Session Cleared')</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}

function password_generate($chars){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}

function sendEmail($newotp,$email,$newpassword){
    
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                           //Disable verbose debug output
    $mail->isSMTP();                                //Send using SMTP
    $mail->Host       = 'mail.javathree99.com';                         //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       //Enable SMTP authentication
    $mail->Username   = 'mystracker@javathree99.com';                         //SMTP username
    $mail->Password   = '9YH4oECcB5tl';                         //SMTP password
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587;
    
    $from = "mystracker@javathree99.com";
    $to = $email;
    $subject = "From Document Tracker. Please reset your password";
    $message = "<p>Your account password has been reset. This is your new password.</p>
    <br>
    <h3>$newpassword</h3>
    <br>
    <a href='https://javathree99.com/s271059/mys_website/php/vertify_account.php?email=".$email."&key=".$newotp."'>Click Here to reactivate your account</a>";

    $mail->setFrom($from,"Document Tracker");
    $mail->addAddress($to);                                             //Add a recipient
    
    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body style="background-color: #F2EBF3;" onload="loadCookies()">
    
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #7952B3">
        <div class="container-fluid">
            <!-- <img src="" alt="logo" class="logoimg" > -->
            <a class="navbar-brand text-light" href="login.php">DOCUMENT TRAKER</a>
            <button class="navbar-toggler" 
                type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNavDropdown" 
                aria-controls="navbarNavDropdown" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-3">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="signup.php">SignUp</a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link" href="admin/dashboard.php">Dashboard</a>-->
                </li>
            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search" required>
                <button class="btn me-5 nav-btn-color" type="submit">Search</button>
            </form> -->
        </div>
        </div>
    </nav>

    <!-- body -->
    <div class="container my-5 rounded shadow login-con" style="background-color: #FFF;">
        <div class="row">
            <div class="col-lg-6 py-2">
                <h3 class="mt-xl-4">Login</h3>
                        
                    <div class="mb-3">
                        <form method="post" name="loginForm" onsubmit="return validateLoginForm()">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Position</label>
                        <select class="form-select" aria-label="Default select example" name="position">
                            <option selected>Choose a Position</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="rememberme" name="rememberme">
                        <label class="form-check-label" for="flexCheckChecked"> Remember Me </label>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-3 col-xl-3">
                            <button type="submit" class="btn login-btn-color px-4 text-light" name="login" value="login">Login</button>
                        </div>
                        </form>
                        <div class="col-2 col-md-1 col-xl-4"></div>
                        <div class="col-7 col-md-8 col-xl-5">
                            <button class="forgetbtn btn btn-outline float-end" data-bs-toggle="modal" data-bs-target="#forgetPasswordModal">Forgot Your Password ?</button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6 py-xl-2 py-sm-4 py-2">
                <img src="../assets/images/login.jpg" class="loginimg img-fluid " alt="image" />
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="forgetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Forget Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <!--<div class="mb-3">-->
                    <!--    <label for="exampleInputEmail1" class="form-label">Password</label>-->
                    <!--    <input type="number" class="form-control" id="submitedDocument1" name="submitedDocument" aria-describedby="emailHelp" required>-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name="forget_password">Submit</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="main-footer footer-css">
        <div class="footer-middle py-sm-3" style="background: #F2F2F2">
            <div class="container">  
                <div class="footer-bottom">
                    <p class="text-xs-center footer-title-text">
                        &copy; <script>document.write(new Date().getFullYear())</script> Document Traker - ISO Document Submission Tracking System
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function validateLoginForm() {
        var email = document.forms["loginForm"]["email"].value;
        var password = document.forms["loginForm"]["password"].value;
        if ((email === "") || (password === "")) {
            alert("Please fill out your email/password");
            return false;
        }
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(String(email))) {
            alert("Please correct your email");
            return false;
        }
        setCookies(10);
    }

    function setCookies(exdays) {
        var email = document.forms["loginForm"]["email"].value;
        var password = document.forms["loginForm"]["password"].value;
        var rememberme = document.forms["loginForm"]["rememberme"].checked;
        console.log(email, password, rememberme);
        if (rememberme) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = "cusername=" + email + ";" + expires + ";path=/";
            document.cookie = "cpass=" + password + ";" + expires + ";path=/";
            document.cookie = "rememberme=" + rememberme + ";" + expires + ";path=/";
    
        } else {
            document.cookie = "cusername=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
            document.cookie = "cpass=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
            document.cookie = "rememberme=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
        }
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function loadCookies() {
        var username = getCookie("cusername");
        var password = getCookie("cpass");
        var rememberme = getCookie("rememberme");
        console.log("COOKIES:" + username, password, rememberme);
        document.forms["loginForm"]["email"].value = username;
        document.forms["loginForm"]["password"].value = password;
        if (rememberme) {
            document.forms["loginForm"]["rememberme"].checked = true;
        } else {
            document.forms["loginForm"]["rememberme"].checked = false;
        }
    }
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>