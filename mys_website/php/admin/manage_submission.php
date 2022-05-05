<?php
session_start();
include("dbconnect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/Exception.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/PHPMailer.php';
require '/home8/javathre/public_html/s271059/mys_website/php/PHPMailer/SMTP.php';

if(isset($_POST['submitAttendance'])){
    
    $submission_id = $_POST["submission_id"];
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
    if ($_FILES["file"]["size"] > 1000000) {
        
        echo "<script type='text/javascript'>alert('Cant upload more than 1mb file !!!');window.location.assign('manage_submission.php');</script>'";
    }else{
        
        $sqlsearch = "SELECT * FROM tbl_submission WHERE submission_id = '$submission_id'";
        $result = $con->query($sqlsearch);
        if ($result->num_rows > 0){
            
            $sqlsubmitAttendance = "UPDATE tbl_submission SET attendance_filename = '$fileName', attendance_filetype = '$ext' WHERE submission_id = '$submission_id'";
            
            if($con->query($sqlsubmitAttendance) === TRUE)
            {
                
                move_uploaded_file($file["tmp_name"], "../../assets/files/manage_submission/".$submission_id.".".$ext);
                echo "<script type='text/javascript'>alert('Success!!!');window.location.assign('manage_submission.php');</script>'";
                
            }else{
                echo "<script type='text/javascript'>alert('Failed!!!');window.location.assign('manage_submission.php');</script>'";
            }
        }
    }
    
    
}else if (isset($_POST['deleteSubmission'])){
        
    $submission_id = $_POST["submission_id2"];
    
    $sqlsearch = "SELECT * FROM tbl_submission WHERE submission_id = '$submission_id'";
    
    $result = $con->query($sqlsearch);
    if ($result->num_rows > 0){
        while ($row = $result -> fetch_assoc()){
            extract($row);
            
            if($EAL == "submited" or $TST == "submited" or $EQS == "submited" or $ans_scheme == "submited" or $ER == "submited" or $AL == "submited" or $syllabus == "submited" or $SoW == "submited"){
                
                echo "<script type='text/javascript'>alert('Delete Failed ! Already submit document !!!');window.location.assign('manage_submission.php');</script>'";
            
                
            }else{
        
                $deleteSubmission = "DELETE FROM `tbl_submission` WHERE email = '$email' ";
                
                if($con->query($deleteSubmission) === TRUE)
                {
                    if($attendance_filename != "-" or $attendance_filetype != "-"){
                    
                        unlink("../../assets/files/manage_submission/".$submission_id.".".$attendance_filetype);
                    }
                    echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_submission.php');</script>'";
                }else{
                    echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_submission.php');</script>'";
                }
            }
        }
        
    }
}else if (isset($_POST['sendNotification'])){
    
    // $category = $_POST["eal"];
    // $category = $_POST["tst"];
    // $category = $_POST["eqs"];
    // $category = $_POST["answer_scheme"];
    // $category = $_POST["er"];
    // $category = $_POST["al"];
    // $category = $_POST["syllabus"];
    // $category = $_POST["sow"];
        
    $email = $_POST["email"];
    $category = $_POST["category"];
    $name = $_POST["name"];
    
    // echo $email;
    // echo $name;

    sendEmail($email,$category,$name);
    echo "<script type='text/javascript'>alert('Sent Successful !!!');window.location.assign('manage_submission.php');</script>'";
}

function sendEmail($email,$category,$name){
    
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
    $subject = "From Document Tracker. Please submit your document";
    $index = 1 ;
    $message .= "<p>Hi $name, Please submit the following documents at the below:<br><br> ";
    foreach($category as $item){
        $message .= "$index".". "."$item <br>";
        $index++;
    }
    
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
    <title>Manage Submissions</title>
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
                      <li><a class="dropdown-item" href="manage_profile.php">Profile</a></li>
                      <li><a class="dropdown-item" href="manage_report.php">Report</a></li>
                      <li><a class="dropdown-item active" href="manage_submission.php">Submission Status</a></li>
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
            <!--<div class="col">-->
            <!--<div class="col-5 col-sm-4 col-lg-6 col-xxl-8">-->
            <!--    <button class="btn userlist-btn float-end text-light" data-bs-toggle="modal" data-bs-target="#addSubmissionModal">Add Submission</button>-->
            <!--</div>-->
            <!--<div class="col-7 col-sm-4 col-lg-3 col-xxl-2">-->
            <!--    <a class="btn userlist-btn float-end text-light" href="manage_report_submit.php">User List (Submited)</a>-->
            <!--</div>-->
            <!--<div class="col-12 col-sm-4 col-lg-3 col-xxl-2 mt-2 mt-sm-0">-->
            <!--    <a class="btn userlist-btn float-end text-light" href="manage_report_nosubmit.php">User List (No Submit)</a>-->
            <!--</div>-->
        </div>
    </div>
    <div class="container">
        <div class="row my-4 px-3 px-sm-0">
            <div class="card shadow mb-4">
                <div class="card-body ">
                    <h1 class="text-center mb-3">Submission List</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th rowspan="2">Bil.</th>
                                    <th colspan="4" class="text-center">Profile</th>
                                    <th colspan="9" class="text-center">Submission Status</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Exam Announcement Letter</th>
                                    <th>Test Specification Table</th>
                                    <th>Examination Question Script</th>
                                    <th>Answer Scheme</th>
                                    <th>Endorsed Result</th>
                                    <th>Appoint Letter</th>
                                    <th>Syllabus</th>
                                    <th>Scheme of Work</th>
                                    <th>Attendance File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    		    session_start();
                                error_reporting(0);
                                include("dbconnect.php");
                                // echo $_SESSION["email"];
                                // $email = $_SESSION['email'];
                                $index = 1;
                                $sqlloadsubmission = "SELECT a.submission_id, a.email, a.EAL, a.TST, a.EQS, a.ans_scheme, a.ER, a.AL, a.syllabus, a.SoW, a.attendance_filename, a.attendance_filetype, b.status, b.subject, b.semester, c.name
                                FROM tbl_submission a  
                                JOIN tbl_profile b
                                ON b.email = a.email
                                JOIN tbl_user c
                                ON c.email= b.email
                                ORDER BY submission_id ASC";
                                
                                $result = $con->query($sqlloadsubmission);
                                if ($result->num_rows > 0){
                                    while ($row = $result -> fetch_assoc()){
                                        extract($row);
                                        
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $status ?></td>
                                            <td><?php echo $subject ?></td>
                                            <td><?php echo $semester ?></td>
                                            <td><?php echo $EAL ?></td>
                                            <td><?php echo $TST ?></td>
                                            <td><?php echo $EQS ?></td>
                                            <td><?php echo $ans_scheme ?></td>
                                            <td><?php echo $ER ?></td>
                                            <td><?php echo $AL ?></td>
                                            <td><?php echo $syllabus ?></td>
                                            <td><?php echo $SoW ?></td>
                                            <?php
                                            if($attendance_filetype == "-"){
                                                ?>
                                                <td>No document</td>
                                                <?php
                                                
                                            }else{
                                                if($attendance_filetype == "docx"){
                                                    ?>
                                                    <td><a href="../../assets/files/manage_submission/<?php echo $submission_id.".".$attendance_filetype ?>"  download="<?php echo $attendance_filename ?>"><img src="../../assets/images/words.png" style="width: 24px; height: 24px" alt="docx"></a></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td><a href="../../assets/files/manage_submission/<?php echo $submission_id.".".$attendance_filetype ?>" download="<?php echo $attendance_filename ?>"><img src="../../assets/images/pdf.jpg" style="width: 24px; height: 24px" alt="pdf"></a></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <td>
                                                <i class="bi bi-file-arrow-up me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#submitAttendanceModal" onclick="submitDialog('<?php echo $submission_id ?>')"></i>
                                                <i class="bi bi-bell me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#notificationModal" onclick="notificationDialog('<?php echo $email ?>','<?php echo $name ?>','<?php echo $EAL ?>','<?php echo $TST ?>','<?php echo $EQS ?>','<?php echo $ans_scheme ?>','<?php echo $ER ?>','<?php echo $AL ?>','<?php echo $syllabus ?>','<?php echo $SoW ?>')"></i>
                                                <i class="bi bi-trash" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteDialog('<?php echo $submission_id ?>')"></i>
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
    <div class="modal fade" id="updateSubmissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Submissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <p class="h6">Examination Announcement Letter</p> 
                    <input type="hidden" class="form-control" id="document" name="document" aria-describedby="emailHelp" required>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="percentage" name="percentage" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal">Save</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!--Modal-->
    
    <div class="modal fade" id="addSubmissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <select class="form-select" aria-label="Default select example" name="profile_id">
                                <!--<option selected>Open this select menu</option>-->
                                <?php
                                    session_start();
                                    error_reporting(0);
                                    include("dbconnect.php");
                                    
                                    $sqlloadprofile = "SELECT * FROM tbl_profile";
                                    $result = $con->query($sqlloadprofile);
                                    if ($result->num_rows > 0){
                                        while ($row = $result -> fetch_assoc()){
                                            extract($row);
                                            
                                            ?>
                                            <option value="<?php echo $profile_id; ?>"><?php echo $name; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Submited Document</label>
                            <input type="number" class="form-control" id="submitedDocument1" name="submitedDocument" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Not Submit Document</label>
                            <input type="number" class="form-control" id="noSubmitDocument1" name="noSubmitDocument" aria-describedby="emailHelp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name="submitReport">Save</button>
                        <button type="reset" class="btn btn-outline-warning reset-btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--Modal-->
    <div class="modal fade" id="submitAttendanceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Submit Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="submission_id" name="submission_id" aria-describedby="emailHelp" required>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="file" name="file" aria-describedby="emailHelp" accept="file_extension/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-warning reset-btn">Reset</button>
                    <button type="submit" class="btn userlist-btn text-light" name='submitAttendance'>Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="notificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Send email to:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body" >
                    <input type="hidden" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <input type="hidden" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                    <!--<div class="row mb-2">-->
                    <!--    <div class="col-11">-->
                    <!--        <label for="exampleInputEmail1" class="form-label">Select All</label>-->
                    <!--    </div>-->
                    <!--    <div class="col-1">-->
                    <!--        <input onchange="selectAllCheckboxes()" class="form-check-input" type="checkbox" value="Examination Announcement Letter" id="checkBoxAll" >-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="row mb-2" id="ealDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Examination Announcement Letter</label>
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Examination Announcement Letter" id="eal" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="tstDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Test Specification Table</label>
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Test Specification Table" id="tst" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="eqsDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Examination Question Script</label>                        
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Examination Question Script" id="eqs" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="ans_schemeDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Answer Scheme</label>                       
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Answer Scheme" id="answer_scheme" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="erDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Endorsed Result</label>                       
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Endorsed Result" id="er" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="alDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Appointment Letter</label>                      
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Appointment Letter" id="al" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="syllabusDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Syllabus</label>                      
                        </div>
                        <div class="col-1" id="ealDiv">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Syllabus" id="syllabus" name="category[]">
                        </div>
                    </div>
                    <div class="row mb-2" id="sowDiv">
                        <div class="col-11">
                            <label for="exampleInputEmail1" class="form-label">Scheme of Work</label>                    
                        </div>
                        <div class="col-1">
                            <input class="form-check-input checkbox-option" type="checkbox" value="Scheme of Work" id="sow" name="category[]">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-warning reset-btn">Reset</button>
                    <button type="submit" class="btn userlist-btn text-light" name='sendNotification' data-bs-dismiss="modal">Send</button>
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
                    <input type="hidden" class="form-control" id="submission_id2" name="submission_id2" aria-describedby="emailHelp" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light" name='deleteSubmission'>Yes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
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
            "columnDefs": [
                { "width": "17%", "targets": 10 }
            ]
        })
    });
    
    function submitDialog(submission_id){
        
    	document.getElementById('submission_id').value=submission_id;

    }
    
    function notificationDialog(email, name, eal, tst, eqs, ans_scheme, er, al, syllabus, sow){
        
    	document.getElementById('email').value=email;
        document.getElementById('name').value=name;
        
        var element1 = document.getElementById("ealDiv");
        var element2 = document.getElementById("tstDiv");
        var element3 = document.getElementById("eqsDiv");
        var element4 = document.getElementById("ans_schemeDiv");
        var element5 = document.getElementById("erDiv");
        var element6 = document.getElementById("alDiv");
        var element7 = document.getElementById("syllabusDiv");
        var element8 = document.getElementById("sowDiv");
        
        if(eal == "submited"){
            element1.style.display = "none";
        }else{
            element1.style.display = "flex";
        }
        
        if(tst == "submited"){
            element2.style.display = "none";
        }else{
            element2.style.display = "flex";
        }
        
        if(eqs == "submited"){
            element3.style.display = "none";
        }else{
            element3.style.display = "flex";
        }
        
        if(ans_scheme == "submited"){
            element4.style.display = "none";
        }else{
            element4.style.display = "flex";
        }
        
        if(er == "submited"){
            element5.style.display = "none";
        }else{
            element5.style.display = "flex";
        }
        
        if(al == "submited"){
            element6.style.display = "none";
        }else{
            element6.style.display = "flex";
        }
        
        if(syllabus == "submited"){
            element7.style.display = "none";
        }else{
            element7.style.display = "flex";
        }
        
        if(sow == "submited"){
            element8.style.display = "none";
        }else{
            element8.style.display = "flex";
        }
    }
    
    const checkBoxAll = document.querySelector('#checkBoxAll');
    const checkBoxOption = document.querySelectorAll('.checkbox-option');
    
    function selectAllCheckboxes(){
        
        const isChecked = checkBoxAll.checked;
        
        for(let i = 0 ; i < checkBoxOption.length ; i++){
            checkBoxOption[i].checked = isChecked;
        }
    }
    
    function deleteDialog(submission_id){
        
    	document.getElementById('submission_id2').value=submission_id;

    }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>