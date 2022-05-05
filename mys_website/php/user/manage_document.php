<?php

session_start();
include("dbconnect.php");
$email = $_SESSION["email"];

if (isset($_POST['submitFile'])){
    
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $category = $_POST["category"];
    $submited = "submited";
    $noSubmit = "no submit";
    $dash = "-";
    
    $sqlsearchprofile = "SELECT * FROM tbl_profile WHERE email = '$email'";
    $result1 = $con->query($sqlsearchprofile);
    if ($result1->num_rows > 0){
        
        if ($_FILES["file"]["size"] > 1000000) {
        
            echo "<script type='text/javascript'>alert('Cant upload more than 1mb file !!!');window.location.assign('manage_document.php');</script>'";
        }else{
            
            if (isset($category)){
                
                $submitDoc = "INSERT INTO `tbl_document`(`email`, `doc_name`, `type`, `category`, `validation_status`) VALUES('$email','$fileName','$ext','$category','$dash')";
            
                $sqlsearch1 = "SELECT * FROM tbl_submission WHERE email = '$email'";
        
                $result = $con->query($sqlsearch1);
                if ($result->num_rows > 0) {
                    
                    switch ($category) {
                        case 1:
                        $sqlinsert1 = "UPDATE tbl_submission SET EAL = '$submited' WHERE email = '$email'";
                        break;
                        case 2:
                        $sqlinsert1 = "UPDATE tbl_submission SET TST = '$submited' WHERE email = '$email'";
                        break;
                        case 3:
                        $sqlinsert1 = "UPDATE tbl_submission SET EQS = '$submited' WHERE email = '$email'";
                        break;
                        case 4:
                        $sqlinsert1 = "UPDATE tbl_submission SET ans_scheme = '$submited' WHERE email = '$email'";
                        break;
                        case 5:
                        $sqlinsert1 = "UPDATE tbl_submission SET ER = '$submited' WHERE email = '$email'";
                        break;
                        case 6:
                        $sqlinsert1 = "UPDATE tbl_submission SET AL = '$submited' WHERE email = '$email'";
                        break;
                        case 7:
                        $sqlinsert1 = "UPDATE tbl_submission SET syllabus = '$submited' WHERE email = '$email'";
                        break;
                        case 8:
                        $sqlinsert1 = "UPDATE tbl_submission SET SoW = '$submited' WHERE email = '$email'";
                        break;
                    }
                    
                }else{
                    
                    switch ($category) {
                        case 1:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$submited','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 2:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$submited','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 3:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$submited','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 4:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$noSubmit','$submited','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 5:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$submited','$noSubmit','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 6:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$submited','$noSubmit','$noSubmit','$dash','$dash')";
                        break;
                        case 7:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$submited','$noSubmit','$dash','$dash')";
                        break;
                        case 8:
                        $sqlinsert1 = "INSERT INTO tbl_submission(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW,attendance_filename,attendance_filetype) VALUES ('$email','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$noSubmit','$submited','$dash','$dash')";
                        break;
                    }
                }
                
                $sqlsearch2 = "SELECT * FROM tbl_validation WHERE email = '$email'";
                $result = $con->query($sqlsearch2);
                if ($result->num_rows > 0){
                    
                    $sqlinsert2 = "UPDATE tbl_validation SET EAL = '-' WHERE email = '$email'";
                }else{
                    $sqlinsert2 = "INSERT INTO tbl_validation(email,EAL,TST,EQS,ans_scheme,ER,AL,syllabus,SoW) VALUES ('$email','$dash','$dash','$dash','$dash','$dash','$dash','$dash','$dash')";
                }
                
                if($con->query($sqlinsert1) === TRUE and $con->query($sqlinsert2) === TRUE and $con->query($submitDoc) === TRUE)
                {
                    
                    $filename = mysqli_insert_id($con);
                    move_uploaded_file($file["tmp_name"], "../../assets/files/manage_document/".$filename.".".$ext);
                    echo "<script type='text/javascript'>alert('Success!!!');window.location.assign('manage_document.php');</script>'";
                    
                }else{
                    echo "<script type='text/javascript'>alert('Failed!!!');window.location.assign('manage_document.php');</script>'";
                }
                
            }else {
                
                echo "<script type='text/javascript'>alert('Please select a category!!!');window.location.assign('manage_document.php');</script>'";
            }
        }
        
    }else{
        
        echo "<script type='text/javascript'>alert('Cant submit document without profile, Wait admin add profile !!! Please check your email to get the latest notification');window.location.assign('manage_document.php');</script>'";
    }
    
}else if (isset($_POST['updateFile'])){
    
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];
    $category = $_POST["category"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $doc_id = $_POST["doc_id"];
    
    $sql = "SELECT * FROM tbl_document WHERE doc_id = '$doc_id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0){
        
        if ($_FILES["file"]["size"] > 1000000) {
        
            echo "<script type='text/javascript'>alert('Cant upload more than 1mb file !!!');window.location.assign('manage_document.php');</script>'";
            
        }else{
            
            $updateDoc = "UPDATE `tbl_document` SET doc_name = '$fileName', type = '$ext' WHERE doc_id = '$doc_id' AND email = '$email'";
        
            if($con->query($updateDoc) === TRUE)
            {
                
                move_uploaded_file($file["tmp_name"], "../../assets/files/manage_document/".$doc_id.".".$ext);
                echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_document.php');</script>'";
            }else{
                echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_document.php');</script>'";
            }
            
        }
    }else{
        echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_document.php');</script>'";
    }
    
}else if (isset($_POST['deleteFile'])){
    
    $doc_id = $_POST["doc_id"];
    $type = $_POST["type"];
    $category = $_POST["category"];
    $noSubmit = "no submit";
    
    switch ($category) {
        case 1:
        $sqlinsert = "UPDATE tbl_submission SET EAL = '$noSubmit' WHERE email = '$email'";
        break;
        case 2:
        $sqlinsert = "UPDATE tbl_submission SET TST = '$noSubmit' WHERE email = '$email'";
        break;
        case 3:
        $sqlinsert = "UPDATE tbl_submission SET EQS = '$noSubmit' WHERE email = '$email'";
        break;
        case 4:
        $sqlinsert = "UPDATE tbl_submission SET ans_scheme = '$noSubmit' WHERE email = '$email'";
        break;
        case 5:
        $sqlinsert = "UPDATE tbl_submission SET ER = '$noSubmit' WHERE email = '$email'";
        break;
        case 6:
        $sqlinsert = "UPDATE tbl_submission SET AL = '$noSubmit' WHERE email = '$email'";
        break;
        case 7:
        $sqlinsert = "UPDATE tbl_submission SET syllabus = '$noSubmit' WHERE email = '$email'";
        break;
        case 8:
        $sqlinsert = "UPDATE tbl_submission SET SoW = '$noSubmit' WHERE email = '$email'";
        break;
    }
    
    $deleteDoc = "DELETE FROM `tbl_document` WHERE doc_id = '$doc_id' ";
    
    if($con->query($deleteDoc) === TRUE and $con->query($sqlinsert) === TRUE)
    {
        unlink("../../assets/files/manage_document/".$doc_id.".".$type);
        echo "<script type='text/javascript'>alert('Success!');window.location.assign('manage_document.php');</script>'";
    }else{
        echo "<script type='text/javascript'>alert('Failed!!');window.location.assign('manage_document.php');</script>'";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Document</title>
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
                    <a class="nav-link active" href="manage_document.php">Manage Document</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="manage_profile.php">Manage Profile</a>
                </li>
            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search" required>
                <button class="btn me-5 nav-btn-color" type="submit">Search</button>
            </form> -->
            <ul class="navbar-nav" >
                
                <?php
    		    session_start();
                error_reporting(0);
                include("dbconnect.php");
                // echo $_SESSION["email"];
                $email = $_SESSION['email'];
                if (isset($_SESSION["email"])){
                    
                    $sqlloaduser = "SELECT * FROM tbl_user WHERE email = '$email'";
                    $result = $con->query($sqlloaduser);
                    if ($result->num_rows > 0){
                        while ($row = $result -> fetch_assoc()){
                            extract($row);
                            
                            if($img_status =="no"){
                                ?>
                                
                                <li class="nav-item">
                                    <img src="../../assets/images/profile.png" class="profileimg" alt="profileimg">
                                </li>
                                <?php
                            }else{
                                ?>
                                <li class="nav-item">
                                    <img src="../../assets/images/profile.png" class="profileimg" alt="profileimg">
                                </li>
                                <?php
                            }
                            ?>
                            <li class="nav-item mt-1">
                                <a class="nav-link text-light" ><?php echo $name; ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    <li class="nav-item mt-1">
                        <a class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#logoutModal" href="">Logout</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        </div>
    </nav>

    <!-- Body -->
    
    <div class="container">
        <div class="row mt-3">
            <div class="col-6 col-lg-10"></div>
            <div class="col-6 col-lg-2">
                <button class="btn userlist-btn float-end text-light" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Add Document</button>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row my-4 px-3 px-sm-0">
            <div class="card shadow mb-4">
                <div class="card-body ">
                    <h1 class="text-center mb-3">Document List</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Download</th>
                                    <th>Validation Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    session_start();
                                    error_reporting(0);
                                    include("dbconnect.php");
                                    // echo $_SESSION["email"];
                                    $email = $_SESSION['email'];
                                    $index = 1;
                                    
                                    $sqlloaddocument = "SELECT * FROM tbl_document WHERE email = '$email'";
                                    $result = $con->query($sqlloaddocument);
                                    if ($result->num_rows > 0){
                                        while ($row = $result -> fetch_assoc()){
                                            
                                            extract($row);
                                            ?>
                                            <tr>
                                                <td><?php echo $index++ ?></td>
                                                <td><?php echo $doc_name ?></td>
                                                <td><?php echo $type ?></td>
                                                <?php
                                                switch ($category) {
                                                    case 1:
                                                    ?> <td>Exam Announcement Letter</td> <?php
                                                    break;
                                                    case 2:
                                                    ?> <td>Test Specification Table</td> <?php
                                                    break;
                                                    case 3:
                                                    ?> <td>Examination Question Script</td> <?php
                                                    break;
                                                    case 4:
                                                    ?> <td>Answer Scheme</td> <?php
                                                    break;
                                                    case 5:
                                                    ?> <td>Endorsed Result</td> <?php
                                                    break;
                                                    case 6:
                                                    ?> <td>Appointment Letter</td> <?php
                                                    break;
                                                    case 7:
                                                    ?> <td>Syllabus</td> <?php
                                                    break;
                                                    case 8:
                                                    ?> <td>Scheme of Work</td> <?php
                                                    break;
                                                }
                                                if($type == "docx"){
                                                    ?>
                                                    <td><a href="../../assets/files/manage_document/<?php echo $doc_id.".".$type ?>"  download="<?php echo $doc_name ?>"><img src="../../assets/images/words.png" style="width: 24px; height: 24px" alt="docx"></a></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td><a href="../../assets/files/manage_document/<?php echo $doc_id.".".$type ?>" download="<?php echo $doc_name ?>"><img src="../../assets/images/pdf.jpg" style="width: 24px; height: 24px" alt="pdf"></a></td>
                                                    <?php
                                                }
                                                ?>
                                                <td><?php echo $validation_status ?></td>
                                                <?php
                                                if($validation_status == "yes"){
                                                    ?>
                                                    <td></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td>
                                                        <!--<i class="bi bi-pencil me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateDocumentModal" onclick="updateDialog('<?php echo $doc_id ?>')"></i>-->
                                                        <i class="bi bi-trash" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteDialog('<?php echo $doc_id ?>','<?php echo $type ?>','<?php echo $category ?>')"></i>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
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
    <div class="modal fade" id="addDocumentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Submit Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="submitForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <!--<p class="h6">Examination Announcement Letter</p> -->
                    <input type="hidden" class="form-control" id="document" name="document" aria-describedby="emailHelp" required>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="file" name="file" aria-describedby="emailHelp" accept="file_extension/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category</label>
                        <?php
                            session_start();
                            error_reporting(0);
                            include("dbconnect.php");
                            // echo $_SESSION["email"];
                            $email = $_SESSION['email'];
                            // echo $email;
                            $sqlloadsubmission = "SELECT * FROM tbl_submission WHERE email = '$email'";
                            $result = $con->query($sqlloadsubmission);
                            if ($result->num_rows > 0){
                                while ($row = $result -> fetch_assoc()){
                                    extract($row);
                                    ?>
                                    <select class="form-select" aria-label="Default select example" name="category">
                                        <option selected>Select category</option>
                                        <option value="1" <?php if($EAL=='submited'){echo "hidden='hidden'";} ?> >Exam Announcement Letter</option>
                                        <option value="2" <?php if($TST=='submited'){echo "hidden='hidden'";} ?> >Test Specification Table</option>
                                        <option value="3" <?php if($EQS=='submited'){echo "hidden='hidden'";} ?> >Examination Question Script</option>
                                        <option value="4" <?php if($ans_scheme=='submited'){echo "hidden='hidden'";} ?> >Answer Scheme</option>
                                        <option value="5" <?php if($ER=='submited'){echo "hidden='hidden'";} ?> >Endorsed Result</option>
                                        <option value="6" <?php if($AL=='submited'){echo "hidden='hidden'";} ?> >Appointment Letter</option>
                                        <option value="7" <?php if($syllabus=='submited'){echo "hidden='hidden'";} ?> >Syllabus</option>
                                        <option value="8" <?php if($SoW=='submited'){echo "hidden='hidden'";} ?> >Scheme of Work</option>
                                    </select>
                                    <?php
                                }
                            }else{
                                ?>
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <!--<option selected>Select category</option>-->
                                    <option value="1" >Exam Announcement Letter</option>
                                    <option value="2" >Test Specification Table</option>
                                    <option value="3" >Examination Question Script</option>
                                    <option value="4" >Answer Scheme</option>
                                    <option value="5" >Endorsed Result</option>
                                    <option value="6" >Appointment Letter</option>
                                    <option value="7" >Syllabus</option>
                                    <option value="8" >Scheme of Work</option>
                                </select>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name='submitFile'>Submit</button>
                    <button type="reset" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateDocumentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="submitForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="h6">Examination Announcement Letter</p> 
                    <input type="hidden" class="form-control" id="doc_id1" name="doc_id" aria-describedby="emailHelp" required>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="file" name="file" aria-describedby="emailHelp" accept="file_extension/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option selected>Select category</option>
                            <option value="1" >Exam Announcement Letter</option>
                            <option value="2" >Test Specification Table</option>
                            <option value="3" >Examination Question Script</option>
                            <option value="4" >Answer Scheme</option>
                            <option value="5" >Endorsed Result</option>
                            <option value="6" >Appointment Letter</option>
                            <option value="7" >Syllabus</option>
                            <option value="8" >Scheme of Work</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn userlist-btn text-light" data-bs-dismiss="modal" name='updateFile' value="Submit">Update</button>
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
                    <input type="hidden" class="form-control" id="doc_id2" name="doc_id" aria-describedby="emailHelp" required>
                    <input type="hidden" class="form-control" id="type" name="type" aria-describedby="emailHelp" required>
                    <input type="hidden" class="form-control" id="category" name="category" aria-describedby="emailHelp" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light" name='deleteFile'>Yes</button>
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
        })
    });
    
    function updateDialog(doc_id){
    	
    	document.getElementById('doc_id1').value=doc_id;
    	
    }
    
    function deleteDialog(doc_id, type, category){
        
    	document.getElementById('doc_id2').value=doc_id;
    	document.getElementById('type').value=type;
    	document.getElementById('category').value=category;
    	
    }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>