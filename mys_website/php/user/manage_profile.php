<?php

    session_start();
    include("dbconnect.php");
    
    if (isset($_POST['updateProfile'])){
        
        $profile_id = $_POST["profile_id"];
        $email = $_POST["email"];
        $status = $_POST["status"];
        $subject = $_POST["subject"];
        $semester = $_POST["semester"];
        
        $loadProfile = "SELECT * FROM tbl_profile WHERE profile_id = '$profile_id'";
        $result = $con->query($loadProfile);
        if ($result->num_rows > 0){
                
            $updateProfile = "UPDATE `tbl_profile` SET status = '$status', subject = '$subject', semester = '$semester' WHERE profile_id = '$profile_id'";
        
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
                    <a class="nav-link text-light" href="manage_document.php">Manage Document</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="manage_profile.php">Manage Profile</a>
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
        <div class="row my-4 px-3 px-sm-0">
            <div class="card shadow mb-4">
                <div class="card-body ">
                    <h1 class="text-center mb-3">Manage Profile</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>Bil.</th>
                                    <th>Name</th>
                                    <!--<th>Email</th>-->
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
                                // echo $email;
                                $index = 1;
                                
                                $sqlloadprofile = "SELECT * FROM tbl_profile WHERE email = '$email'";
                                $result = $con->query($sqlloadprofile);
                                if ($result->num_rows > 0){
                                    while ($row = $result -> fetch_assoc()){
                                        extract($row);
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <!--<td><?php echo $email ?></td>-->
                                            <td><?php echo $status ?></td>
                                            <td><?php echo $subject ?></td>
                                            <td><?php echo $semester ?></td>
                                            <td>
                                                <i class="bi bi-pencil me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateProfileModal" onclick="updateDialog('<?php echo $profile_id ?>','<?php echo $email ?>','<?php echo $status ?>','<?php echo $subject ?>','<?php echo $semester ?>')"></i>
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
    
    <!--Modal-->
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
                    <!--<div class="mb-2">-->
                        <!--<label for="exampleInputEmail1" class="form-label">Email</label>-->
                        <input type="hidden" class="form-control" id="profile_email" name="email" aria-describedby="emailHelp" required>
                    <!--</div>-->
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
                    
                    <!--<input type="hidden" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" required>-->
                
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
    
    function deleteDialog(profile_id){
        
    	document.getElementById('profile_id2').value=profile_id;

    }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>