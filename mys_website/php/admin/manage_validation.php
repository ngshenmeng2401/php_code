<?php
session_start();
include("dbconnect.php");

if (isset($_POST['updateValidation'])){
    
    $validation_id = $_POST["validation_id1"];
    $eal = $_POST["eal"];
    $tst = $_POST["tst"];
    $eqs = $_POST["eqs"];
    $ans_scheme = $_POST["ans_scheme"];
    $er = $_POST["er"];
    $al = $_POST["al"];
    $syllabus = $_POST["syllabus"];
    $sow = $_POST["sow"];
    
    $sql = "SELECT * FROM tbl_validation WHERE validation_id = '$validation_id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0){
        
        $updateValidation = "UPDATE `tbl_validation` SET EAL = '$eal', TST = '$tst', EQS = '$eqs', ans_scheme = '$ans_scheme', ER = '$er', AL = '$al', syllabus = '$syllabus', SoW = '$sow' WHERE validation_id = '$validation_id'";
    
        if($con->query($updateValidation) === TRUE)
        {
            
            echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_validation.php');</script>'";
        }else{
            echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_validation.php');</script>'";
        }
    }else{
        echo "<script type='text/javascript'>alert('No any record !!!');window.location.assign('manage_validation.php');</script>'";
    }
    
}else if (isset($_POST['deleteValidation'])){
    
    $validation_id = $_POST["validation_id2"];
    
    $sql = "SELECT * FROM tbl_validation WHERE validation_id = '$validation_id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result -> fetch_assoc()){
            extract($row);
            
            if($EAL != "-" or $TST != "-" or $EQS != "-" or $ans_scheme != "-" or $ER != "-" or $AL != "-" or $syllabus != "-" or $SoW != "-"){
                
                echo "<script type='text/javascript'>alert('Delete Failed ! Already conduct validation !!!');window.location.assign('manage_validation.php');</script>'";
            }else{
                
                $deleteValidation = "DELETE FROM `tbl_validation` WHERE validation_id = '$validation_id' ";
    
                if($con->query($deleteValidation) === TRUE)
                {
                    echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_validation.php');</script>'";
                }else{
                    echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_validation.php');</script>'";
                }
            }
        }
    }else{
        
        echo "<script type='text/javascript'>alert('No any record !!!');window.location.assign('manage_validation.php');</script>'";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Validation</title>
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
                      <li><a class="dropdown-item" href="manage_submission.php">Submission Status</a></li>
                      <li><a class="dropdown-item active" href="manage_validation.php">Validation Status</a></li>
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
                <!--<button class="btn userlist-btn float-end text-light" data-bs-toggle="modal" data-bs-target="#addSubmissionModal">Add Validation</button>-->
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
                    <h1 class="text-center mb-3">Validation List</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th rowspan="2">Bil.</th>
                                    <th colspan="4" class="text-center">Profile</th>
                                    <th colspan="9" class="text-center">Validation Status</th>
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
                                $sqlloadvalidation = "SELECT a.validation_id, a.email, a.EAL, a.TST, a.EQS, a.ans_scheme, a.ER, a.AL, a.syllabus, a.SoW, d.submission_id, d.attendance_filename, d.attendance_filetype, b.status, b.subject, b.semester, c.name
                                FROM tbl_validation a  
                                JOIN tbl_profile b
                                ON b.email = a.email
                                JOIN tbl_user c
                                ON c.email= b.email
                                JOIN tbl_submission d
                                ON d.email= a.email
                                ORDER BY validation_id ASC";
                                
                                $result = $con->query($sqlloadvalidation);
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
                                                <i class="bi bi-pencil me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateValidationModal" onclick="updateDialog('<?php echo $validation_id ?>','<?php echo $EAL ?>','<?php echo $TST ?>','<?php echo $EQS ?>','<?php echo $ans_scheme ?>','<?php echo $ER ?>','<?php echo $AL ?>','<?php echo $syllabus ?>','<?php echo $SoW ?>')"></i>
                                                <i class="bi bi-trash" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteDialog('<?php echo $validation_id ?>')"></i>
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
    <div class="modal fade" id="updateValidationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Validation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                <input type="hidden" class="form-control" id="validation_id1" name="validation_id1" aria-describedby="emailHelp" required>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Examination Announcement Letter</label>
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="eal" aria-label="Default select example" name="eal">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Test Specification Table</label>
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="tst" aria-label="Default select example" name="tst">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Examination Question Script</label>                        
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="eqs" aria-label="Default select example" name="eqs">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Answer Scheme</label>                       
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="ans_scheme" aria-label="Default select example" name="ans_scheme">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Endorsed Result</label>                       
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="er" aria-label="Default select example" name="er">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Appointment Letter</label>                      
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="al" aria-label="Default select example" name="al">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Syllabus</label>                      
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="syllabus" aria-label="Default select example" name="syllabus">
                                <option value="-" >-</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <label for="exampleInputEmail1" class="form-label">Scheme of Work</label>                    
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="sow" aria-label="Default select example" name="sow">
                                <option value="-" >-</option>
                                <option value="Yes" >Yes</option>
                                <option value="No" >No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name="updateValidation">Update</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn">Reset</button>
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
                    <input type="hidden" class="form-control" id="validation_id2" name="validation_id2" aria-describedby="emailHelp" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light" name='deleteValidation'>Yes</button>
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
    
    function updateDialog(validation_id, eal, tst, eqs, ans_scheme, er, al, syllabus, sow){
        
    	document.getElementById('validation_id1').value=validation_id;
    	
    	document.getElementById('eal').value=eal;
    	document.getElementById('tst').value=tst;
    	document.getElementById('eqs').value=eqs;
    	document.getElementById('ans_scheme').value=ans_scheme;
    	document.getElementById('er').value=er;
    	document.getElementById('al').value=al;
    	document.getElementById('syllabus').value=syllabus;
        document.getElementById('sow').value=sow;
    }
    
    function deleteDialog(validation_id){
        
    	document.getElementById('validation_id2').value=validation_id;

    }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>