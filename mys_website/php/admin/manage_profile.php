<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/Exception.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/PHPMailer.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/SMTP.php';

    session_start();
    include("dbconnect.php");
    
    if (isset($_POST['submitProfile'])){
        $email = $_POST["email"];
        $status = $_POST["status"];
        $subject = $_POST["subject"];
        $semester = $_POST["semester"];
            
        $submitProfile = "INSERT INTO `tbl_profile`(`email`, `status`, `subject`, `semester`) VALUES('$email','$status','$subject','$semester')";
        
        if($con->query($submitProfile) === TRUE)
        {
            
            echo "<script type='text/javascript'>alert('Success!!!');window.location.assign('manage_profile.php');</script>'";
            
        }else{
            echo "<script type='text/javascript'>alert('Failed!!!');window.location.assign('manage_profile.php');</script>'";
        }
        
    }else if (isset($_POST['updateProfile'])){
        
        $profile_id = $_POST["profile_id"];
        $email = $_POST["email"];
        $status = $_POST["status"];
        $subject = $_POST["subject"];
        $semester = $_POST["semester"];
        
        $loadProfile = "SELECT * FROM tbl_profile WHERE profile_id = '$profile_id'";
        $result = $con->query($loadProfile);
        if ($result->num_rows > 0){
                
            $updateProfile = "UPDATE `tbl_profile` SET email = '$email', status = '$status', subject = '$subject', semester = '$semester' WHERE profile_id = '$profile_id'";
        
            if($con->query($updateProfile) === TRUE)
            {
                
                echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_profile.php');</script>'";
            }else{
                echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_profile.php');</script>'";
            }
            
        }else{
            echo "<script type='text/javascript'>alert('No any record !!!');window.location.assign('manage_profile.php');</script>'";
        }
        
    }else if (isset($_POST['deleteProfile'])){
        
        $profile_id = $_POST["profile_id"];

        $deleteProfile = "DELETE FROM `tbl_profile` WHERE profile_id = '$profile_id' ";
        
        if($con->query($deleteProfile) === TRUE)
        {
            echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_profile.php');</script>'";
        }else{
            echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_profile.php');</script>'";
        }
        
    }else if (isset($_POST['sendNotification'])){
        
        $email = $_POST["profile_email2"];
        $name = $_POST["name"];
        // echo $name;
        sendEmail($email,$name);
        echo "<script type='text/javascript'>alert('Sent Successful !!!');window.location.assign('manage_profile.php');</script>'";
    }
    
    function sendEmail($email, $name){
    
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
        $subject = "From Document Tracker. Your profile has been added";
        $message .= "<p>Hi $name, your profile has been added.<br>";
        $message .= "<br> You can submit your document.<br>";
        $message .= "<br> Thank You";
    
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
    <title>Manage Profile</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/manage_report.css">
</head>
<body style="background-color: #F2EBF3;">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #693D70">
        <div class="container-fluid">
            <!-- <img src="" alt="logo" class="logoimg" > -->
            <a class="navbar-brand text-light" href="dashboard.php">DOCUMENT TRAKER</a>
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
                    <a class="nav-link text-light" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Manage
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="manage_document.php">Document</a></li>
                      <li><a class="dropdown-item active" href="manage_profile.php">Profile</a></li>
                      <li><a class="dropdown-item" href="manage_report.php">Report</a></li>
                      <li><a class="dropdown-item" href="manage_submission.php">Submission Status</a></li>
                      <li><a class="dropdown-item" href="manage_validation.php">Validation Status</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-light" href="personal_details.php">User Personal Details</a>
                </li>
            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search" required>
                <button class="btn me-5 nav-btn-color" type="submit">Search</button>
            </form> -->
            <ul class="navbar-nav" >
                <li class="nav-item">
                    <img src="../../assets/images/profile.png" class="profileimg" alt="profileimg">
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link text-light" >Admin</a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#logoutModal" href="">Logout</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
  
    <!-- Body -->
    <div class="container">
        <div class="row mt-3">
            <div class="col-6 col-lg-10"></div>
            <div class="col-6 col-lg-2">
                <button class="btn userlist-btn float-end text-light" data-bs-toggle="modal" data-bs-target="#addProfileModal">Add Profile</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-4 px-3 px-sm-0">
            <div class="card shadow mb-4">
                <div class="card-body ">
                    <h1 class="text-center mb-3">User List</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>Bil.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                session_start();
                                    error_reporting(0);
                                    include("dbconnect.php");
                                    $email = $_SESSION['email'];
                                    $index = 1;
                                    
                                    $sqlloadprofile = "SELECT tbl_user.email, tbl_user.name, tbl_profile.profile_id, tbl_profile.status, tbl_profile.subject, tbl_profile.semester FROM tbl_user INNER JOIN tbl_profile ON tbl_profile.email = tbl_user.email ORDER BY tbl_profile.profile_id ASC";
                                    $result = $con->query($sqlloadprofile);
                                    if ($result->num_rows > 0){
                                        while ($row = $result -> fetch_assoc()){
                                            extract($row);
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $name ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $status ?></td>
                                                <td><?php echo $subject ?></td>
                                                <td><?php echo $semester ?></td>
                                                <td>
                                                    <i class="bi bi-pencil me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateProfileModal" onclick="updateDialog('<?php echo $profile_id ?>','<?php echo $email ?>','<?php echo $status ?>','<?php echo $subject ?>','<?php echo $semester ?>')"></i>
                                                    <i class="bi bi-bell me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#notificationModal" onclick="notificationDialog('<?php echo $email ?>','<?php echo $name ?>')"></i>
                                                    <i class="bi bi-trash" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteDialog('<?php echo $profile_id ?>')"></i>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="addProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <select class="form-select" aria-label="Default select example" name="email">
                            <!--<option selected>Open this select menu</option>-->
                            <?php
                                session_start();
                                error_reporting(0);
                                include("dbconnect.php");
                                $position = "user";
                                
                                $sqlloaduser = "SELECT * FROM tbl_user WHERE position = '$position'";
                                $result = $con->query($sqlloaduser);
                                if ($result->num_rows > 0){
                                    while ($row = $result -> fetch_assoc()){
                                        extract($row);
                                        
                                        ?>
                                        <option value="<?php echo $email; ?>"><?php echo $name; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name="submitProfile">Submit</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>

     <div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="profile_id1" name="profile_id" aria-describedby="emailHelp" required>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="profile_email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" class="form-control" id="profile_status" name="status" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="profile_subject" name="subject" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="profile_semester" name="semester" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name="updateProfile">Update</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    Are You Sure ?
                    <input type="hidden" class="form-control" id="profile_id2" name="profile_id" aria-describedby="emailHelp" required>
                    
                    <!--<input type="hidden" class="form-control" id="semester" name="semester" aria-describedby="emailHelp" required>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light" name="deleteProfile">Yes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="notificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Send notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    Are You Sure ?
                    <input type="hidden" class="form-control" id="profile_email2" name="profile_email2" aria-describedby="emailHelp" required>
                    <input type="hidden" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light" name="sendNotification">Yes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!--Modal-->
    
    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Logout ?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are You Sure ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
            <a href="../login.php?status=logout" >
                <button type="button" class="btn userlist-btn text-light">Yes</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="main-footer">
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" class="init">
    $(document).ready( function (){

        var events = $('#events');
        var table = $('#example').DataTable( {
            select: true,
            "pagingType": "full",
        })
    });
    
    function updateDialog(profile_id, email, status, subject, semester){
    	
    	document.getElementById('profile_id1').value=profile_id;
    	document.getElementById('profile_email').value=email;
    	document.getElementById('profile_status').value=status;
    	document.getElementById('profile_subject').value=subject;
    	document.getElementById('profile_semester').value=semester;
    	
    }
    
    function notificationDialog(email, name){
        document.getElementById('profile_email2').value=email;
        document.getElementById('name').value=name;
    }
    
    function deleteDialog(profile_id){
        
    	document.getElementById('profile_id2').value=profile_id;

    }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>