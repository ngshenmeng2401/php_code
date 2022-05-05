<?php

    session_start();
    include("dbconnect.php");
    $email = $_SESSION["email"];
    $filename = $_POST["filename"];
    $type = $_POST["type"];
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileType = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["error"];
    $fileowner = $_POST["fileowner"];
    $remarks = $_POST["remarks"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
    if (isset($_POST['submitFile'])){
        
        $submitDoc = "INSERT INTO `tbl_document`(`email`, `doc_name`, `type`, `owner`, `remark`) VALUES('$email','$fileName','$ext','$fileowner','$remarks')";
        
        if ($_FILES["file"]["size"] > 500000) {
            
            echo "<script type='text/javascript'>alert('Sorry, your file is too large.!!!');window.location.assign('submit_document.php');</script>'";
        }else{
            
            if($con->query($submitDoc) === TRUE)
            {
                
                $filename = mysqli_insert_id($con);
                move_uploaded_file($file["tmp_name"], "../../assets/files/".$filename);
                echo "<script type='text/javascript'>alert('Success!!!');window.location.assign('submit_document.php');</script>'";
                
            }else{
                echo "<script type='text/javascript'>alert('Failed!!!');window.location.assign('submit_document.php');</script>'";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="../../css/header.css">
     <link rel="stylesheet" href="../../css/footer.css">
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
                    <a class="nav-link active" href="submit_document.php">Submit Document</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-light" href="manage_document.php">Manage Document</a>
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
                        <a class="nav-link text-light" href="">Logout</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        </div>
    </nav>

    <!-- Body -->
    <div class="container my-5 pb-3 shadow rounded" style="background-color: #FFF;">
        <div class="row">
            <div class="col-1">

            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col">
                        <h3 class="my-4 text-center">Document Submission</h3>
                        <form method="POST" id="submitForm" enctype="multipart/form-data">
                            <div class="mb-4 row">
                                <label for="staticEmail" class="col-md-2 col-sm-4 col-form-label">File Name</label>
                                <div class="col-md-10 col-sm-8">
                                    <input type="text" class="form-control" id='filename' name='filename' required>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="staticEmail" class="col-md-2 col-sm-4 col-form-label">File Type</label>
                                <div class="col-md-5 col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="type">
                                        <option selected>Choose a File Type</option>
                                        <option value="DOC">DOC</option>
                                        <option value="GIF">GIF</option>
                                        <option value="HTML">HTML</option>
                                        <option value="JPG">JPG</option>
                                        <option value="PDF">PDF</option>
                                        <option value="PNG">PNG</option>
                                        <option value="SVG">SVG</option>
                                        <option value="TIF">TIF</option>
                                        <option value="TXT">TXT</option>
                                        <option value="XLSX">XLSX</option>
                                    </select>
                                </div>
                                <label for="staticEmail" class="col-md-2 col-sm-4 col-form-label">File Owner</label>
                                <div class="col-md-3 col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-1 col-1 mt-2">
                                            <input class="form-check-input" type="radio" name="fileowner" id="flexRadioDefault1" value="True">
                                        </div>
                                        <div class="col-sm-3 col-2 mt-2">
                                            <label for="staticEmail" class="col-sm-3 form-check-label">Yes</label>
                                        </div>
                                        <div class="col-sm-1 col-1 mt-2">
                                            <input class="form-check-input" type="radio" name="fileowner" id="flexRadioDefault2" value="False" checked>
                                        </div>
                                        <div class="col-sm-3 col-2 mt-2">
                                            <label for="staticEmail" class="col-sm-3 form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="staticEmail" class="col-md-2 col-sm-4 col-form-label">File Input</label>
                                <div class="col-md-10 col-sm-8">
                                    <input class="form-control" type="file" id="file" name="file" accept="file_extension|image/*" required>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="staticEmail" class="col-md-2 col-sm-4 col-form-label">Remarks</label>
                                <div class="col-md-10 col-sm-8">
                                    <textarea class="form-control" aria-label="With textarea" name="remarks" form="submitForm" required></textarea>
                                </div>
                            </div>
                            <!--<div class="mb-4 row">-->
                            <!--    <div class="col-md-10 col-sm-8">-->
                            <!--        <input type="hidden" class="form-control" id='email' name='email' required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="mb-4 row">-->
                            <!--    <div class="col-md-10 col-sm-8">-->
                            <!--        <input type="hidden" class="form-control" id='phoneno' name='phoneno' required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="row mb-2">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <div class="row ">
                                        <div class="col-5 col-md-4 col-lg-5">
                                            <button type="submit"  class="form-control btn btn-dark" name='submitFile' value="Submit">Submit</button>
                                        </div>
                                        <div class="col-2 col-md-4 col-lg-2"></div>
                                        <div class="col-5 col-md-4 col-lg-5">
                                            <button type="reset"  class="form-control btn btn-dark" name='' value="Reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1">
                
            </div>
        </div>
    </div>
    <div class="my-lg-4 row"></div>
    <!-- <div class="my-lg-4 row"></div> -->

    <!-- Footer -->
    <div class="main-footer">
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

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>