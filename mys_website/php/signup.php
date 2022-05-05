<?php
include("dbconnect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/Exception.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/PHPMailer.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/SMTP.php';

$name = $_POST["name"];
$email = $_POST["email"];
$refferalCode = $_POST["refferalCode"];
$phone = $_POST["phoneNo"];
$phoneNo = $phone;
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$img_status = "no";
$otp = rand(100000,999999);

if (isset($_POST['signup'])) {
    
    if($password != $confirmPassword){
            //this is javascript - message box and bring u to another page
            echo "<script type='text/javascript'>alert('Password Not match!');window.location.assign('signup.php');</script>'";
    }else{
        
        if($refferalCode == "admin1234"){
            $position = "admin";
        }else{
            $position = "user";
        }
        
        $sqlregister = "INSERT INTO `tbl_user`(`name`, `email`, `phone_no`, `password`, `position`, `img_status`, `otp`) VALUES ('$name','$email','$phoneNo','$password','$position','$img_status','$otp')";
        
        if($con->query($sqlregister) === TRUE){
    
            
            echo "<script>alert('Registration successful, Please check your email to vertify')</script>";
            echo "<script>window.location.replace('../php/login.php')</script>";
            sendEmail($email,$otp);
        }else{
            
            echo "<script>alert('Registration failed')</script>";
            echo "<script>window.location.replace('../php/signup.php')</script>";
            
        }
    }
}

function sendEmail($email,$otp){
    
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
    $subject = "From Document Tracker. Please vertify your account";
    $message = "<p>Click the following link to verify your account<br><br><a href='https://javathree99.com/s271059/mys_website/php/vertify_account.php?email=".$email."&key=".$otp."'>Click Here</a>";

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
    <title>Sign Up</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body style="background-color: #F2EBF3;">
    
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #693D70">
        <div class="container-fluid">
            <!-- <img src="" alt="logo" class="logoimg" > -->
            <a class="navbar-brand text-light" href="home.php">DOCUMENT TRAKER</a>
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
                    <a class="nav-link text-light" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signup.php">SignUp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" ></a>
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
            <div class="col-lg-6 mb-3">
                <img src="../assets/images/signup.jpg" class="loginimg img-fluid mt-3" alt="image" />
            </div>
            <div class="col-lg-6 py-3">
                <!-- <h3>Create Account</h3> -->
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                    <div class="mb-2">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Referral Code</label>
                        <input type="text" class="form-control" id="refferalCode" name="refferalCode" aria-describedby="emailHelp" required>
                      </div>
                    <div class="mb-2">
                        <p class="mb-0">Only admin needs to provide refferal code, other users can put "-".</p>
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Phone No</label>
                        <input type="number" id="phoneNo" name="phoneNo" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-1">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <div>
                        <p id="length" class="invalid">Min 8 characters</p>
                    </div>
                    <button type="submit" class="btn signup-btn-color text-light" id="signup" name="signup" value="signup" disabled>Sign Up</button>
                  </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="main-footer position">
        <div class="footer-middle py-sm-2" style="background: #F2F2F2">
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
        var password = document.getElementById("password");
        var length = document.getElementById("length");
        var signupbtn = document.getElementById("signup");

        // When the user clicks on the password field, show the message box
        password.onfocus = function() {
        document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        password.onblur = function() {
        document.getElementById("message").style.display = "none";
        }

        password.onkeyup = function(){
            if(password.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
                signupbtn.disabled = false;

            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
                signupbtn.disabled = true;
            }
        }
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>