<?php
session_start();
include("dbconnect.php");

//Total Summary

$sqlloaddocument = "SELECT * FROM tbl_document";
$result = $con->query($sqlloaddocument);
if ($result->num_rows > 0){
    
    $totaldocument = mysqli_num_rows( $result );
}

$sqlloadprofile = "SELECT * FROM tbl_profile";
$result = $con->query($sqlloadprofile);
if ($result->num_rows > 0){
    
    $totalprofile = mysqli_num_rows( $result );
}

$sqlloadreport = "SELECT * FROM tbl_report";
$result = $con->query($sqlloadreport);
if ($result->num_rows > 0){
    
    $totalreport = mysqli_num_rows( $result );
}

$sqlloadsubmission = "SELECT * FROM tbl_submission";
$result = $con->query($sqlloadsubmission);
if ($result->num_rows > 0){
    
    $totalsubmission = mysqli_num_rows( $result );
}

// Submission Summary

$sqlloadealSubmited = "SELECT * FROM tbl_submission WHERE EAL = 'submited'";
$result = $con->query($sqlloadealSubmited);
if ($result->num_rows > 0){
    
    $ealSubmited = mysqli_num_rows( $result );
}

$sqlloadealnoSubmit = "SELECT * FROM tbl_submission WHERE EAL = 'no submit'";
$result = $con->query($sqlloadealnoSubmit);
if ($result->num_rows > 0){
    
    $ealnoSubmit = mysqli_num_rows( $result );
}

$sqlloadtstSubmited = "SELECT * FROM tbl_submission WHERE TST = 'submited'";
$result = $con->query($sqlloadtstSubmited);
if ($result->num_rows > 0){
    
    $tstSubmited = mysqli_num_rows( $result );
}

$sqlloadtstnoSubmit = "SELECT * FROM tbl_submission WHERE TST = 'no submit'";
$result = $con->query($sqlloadtstnoSubmit);
if ($result->num_rows > 0){
    
    $tstnoSubmit = mysqli_num_rows( $result );
}

$sqlloadeqsSubmited = "SELECT * FROM tbl_submission WHERE EQS = 'submited'";
$result = $con->query($sqlloadeqsSubmited);
if ($result->num_rows > 0){
    
    $eqsSubmited = mysqli_num_rows( $result );
}

$sqlloadeqsnoSubmit = "SELECT * FROM tbl_submission WHERE EQS = 'no submit'";
$result = $con->query($sqlloadeqsnoSubmit);
if ($result->num_rows > 0){
    
    $eqsnoSubmit = mysqli_num_rows( $result );
}

$sqlloadansSubmited = "SELECT * FROM tbl_submission WHERE ans_scheme = 'submited'";
$result = $con->query($sqlloadansSubmited);
if ($result->num_rows > 0){
    
    $ansSubmited = mysqli_num_rows( $result );
}

$sqlloadansnoSubmit = "SELECT * FROM tbl_submission WHERE ans_scheme = 'no submit'";
$result = $con->query($sqlloadansnoSubmit);
if ($result->num_rows > 0){
    
    $ansnoSubmit = mysqli_num_rows( $result );
}

$sqlloaderSubmited = "SELECT * FROM tbl_submission WHERE ER = 'submited'";
$result = $con->query($sqlloaderSubmited);
if ($result->num_rows > 0){
    
    $erSubmited = mysqli_num_rows( $result );
}

$sqlloadernoSubmit = "SELECT * FROM tbl_submission WHERE ER = 'no submit'";
$result = $con->query($sqlloadernoSubmit);
if ($result->num_rows > 0){
    
    $ernoSubmit = mysqli_num_rows( $result );
}

$sqlloadalSubmited = "SELECT * FROM tbl_submission WHERE AL = 'submited'";
$result = $con->query($sqlloadalSubmited);
if ($result->num_rows > 0){
    
    $alSubmited = mysqli_num_rows( $result );
}

$sqlloadalnoSubmit = "SELECT * FROM tbl_submission WHERE AL = 'no submit'";
$result = $con->query($sqlloadalnoSubmit);
if ($result->num_rows > 0){
    
    $alnoSubmit = mysqli_num_rows( $result );
}

$sqlloadsyllabusSubmited = "SELECT * FROM tbl_submission WHERE syllabus = 'submited'";
$result = $con->query($sqlloadsyllabusSubmited);
if ($result->num_rows > 0){
    
    $syllabusSubmited = mysqli_num_rows( $result );
}

$sqlloadsyllabusnoSubmit = "SELECT * FROM tbl_submission WHERE syllabus = 'no submit'";
$result = $con->query($sqlloadsyllabusnoSubmit);
if ($result->num_rows > 0){
    
    $syllabusnoSubmit = mysqli_num_rows( $result );
}

$sqlloadsowSubmited = "SELECT * FROM tbl_submission WHERE SoW = 'submited'";
$result = $con->query($sqlloadsowSubmited);
if ($result->num_rows > 0){
    
    $sowSubmited = mysqli_num_rows( $result );
}

$sqlloadsownoSubmit = "SELECT * FROM tbl_submission WHERE SoW = 'no submit'";
$result = $con->query($sqlloadsownoSubmit);
if ($result->num_rows > 0){
    
    $sownoSubmit = mysqli_num_rows( $result );
}

//Total each document

$totaleal = $ealSubmited + $ealnoSubmit;
$totaltst = $tstSubmited + $tstnoSubmit;
$totaleqs = $eqsSubmited + $eqsnoSubmit;
$totalans = $ansSubmited + $ansnoSubmit;
$totaler = $erSubmited + $ernoSubmit;
$totalal = $alSubmited + $alnoSubmit;
$totalsyllabus = $syllabusSubmited + $syllabusnoSubmit;
$totalsow = $sowSubmited + $sownoSubmit;

//Total submited document

$totalsubmiteddoc = $ealSubmited + $tstSubmited + $eqsSubmited + $ansSubmited + $erSubmited + $alSubmited + $syllabusSubmited + $sowSubmited;
$totalnosubmitdoc = $ealnoSubmit + $tstnoSubmit + $eqsnoSubmit + $ansnoSubmit + $ernoSubmit + $alnoSubmit + $syllabusnoSubmit + $sownoSubmit;

//Grand total
$grandtotal1 = $totaleal + $totaltst + $totaleqs + $totalans + $totaler + $totalal + $totalsyllabus + $totalsow;
$grandtotal2 = $totalsubmiteddoc + $totalnosubmitdoc;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
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
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Manage
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="manage_document.php">Document</a></li>
                      <li><a class="dropdown-item" href="manage_profile.php">Profile</a></li>
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
        <div class="row">
            <h3 class="mt-4 mt-sm-5"> Dashboard </h3>
            <div class="col">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #4181FD">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Document
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           <?php echo $totaldocument ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-file-earmark-font h3" style="color: #dee2e6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #08846D;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Profile
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $totalprofile ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-file-earmark-person h3" style="color: #dee2e6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #72E6FA;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Report
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php echo $totalreport ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-file-earmark-bar-graph h3" style="color: #dee2e6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card shadow h-100 py-2 " style="border-left: 0.25rem solid #FFC81C;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Submission
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $totalsubmission ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-file-earmark-check h3" style="color: #dee2e6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- File Type Table -->
        <div class="row px-3 px-sm-0">
            <h3 class="mt-3 mt-sm-3"> Submission Summary</h3>
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Exam Announcement Letter</th>
                                <th scope="col">Test Specification Table</th>
                                <th scope="col">Examination Question Script</th>
                                <th scope="col">Answer Scheme</th>
                                <th scope="col">Endorsed Result</th>
                                <th scope="col">Appointment Letter</th>
                                <th scope="col">Syllabus</th>
                                <th scope="col">Scheme of Work</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Submited</th>
                                <td id="">
                                    <?php
                                    if($ealSubmited != 0){
                                        echo $ealSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($tstSubmited != 0){
                                        echo $tstSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($eqsSubmited != 0){
                                        echo $eqsSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($ansSubmited != 0){
                                        echo $ansSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($erSubmited != 0){
                                        echo $erSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($alSubmited != 0){
                                        echo $alSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($syllabusSubmited != 0){
                                        echo $syllabusSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($sowSubmited != 0){
                                        echo $sowSubmited;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalsubmiteddoc != 0){
                                        echo $totalsubmiteddoc;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Not Submit</th>
                                <td id="">
                                    <?php
                                    if($ealnoSubmit != 0){
                                        echo $ealnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($tstnoSubmit != 0){
                                        echo $tstnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($eqsnoSubmit != 0){
                                        echo $eqsnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($ansnoSubmit != 0){
                                        echo $ansnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($ernoSubmit != 0){
                                        echo $ernoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($alnoSubmit != 0){
                                        echo $alnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($syllabusnoSubmit != 0){
                                        echo $syllabusnoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($sownoSubmit != 0){
                                        echo $sownoSubmit;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalnosubmitdoc != 0){
                                        echo $totalnosubmitdoc;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td id="">
                                    <?php
                                    if($totaleal != 0){
                                        echo $totaleal;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totaltst != 0){
                                        echo $totaltst;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totaleqs != 0){
                                        echo $totaleqs;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalans != 0){
                                        echo $totalans;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totaler != 0){
                                        echo $totaler;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalal != 0){
                                        echo $totalal;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalsyllabus != 0){
                                        echo $totalsyllabus;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($totalsow != 0){
                                        echo $totalsow;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td id="">
                                    <?php
                                    if($grandtotal1 == $grandtotal2){
                                        echo $grandtotal2;
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- File & Graphic Type Chart -->
        <div class="row mt-4">
            <div class="col-0 col-md-5 col-lg-5">
                <!-- Pie Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-transparent py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800">Submited Document Sumarry</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="fileTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-md-2 col-lg-2"></div>
            <div class="col-0 col-md-5 col-lg-5">
                <!-- Pie Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-transparent py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800">No Submit Document Sumarry</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="graphicTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Model-->
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let fileTypeChart = document.getElementById('fileTypeChart').getContext('2d');
        let massPopChart1 = new Chart(fileTypeChart, {

            type: 'pie',
            data: {
                labels: ['Exam Announcement Letter', 'Test Specification Table', 'Examination Question Script', 'Answer Scheme','Endorsed Result','Appointment Letter','Syllabus','Scheme of Work'],
                // label:["a", "b", "c", "d", "e", "f", "g", "h"],
                datasets: [
                    {
                        data: [<?php echo $ealSubmited ?>, <?php echo $tstSubmited ?>, <?php echo $eqsSubmited ?>, <?php echo $ansSubmited ?>, <?php echo $erSubmited ?>, <?php echo $alSubmited ?>, <?php echo $syllabusSubmited ?>, <?php echo $sowSubmited ?>],
                        // data: [1, 2, 3, 4, 5, 4, 3, 2],
                        backgroundColor: [
                            'rgba(255, 0, 20, 0.3)',
                            'rgba(255, 165, 0, 0.3)',
                            'rgba(255, 225, 0, 0.3)',
                            'rgba(75, 192, 113, 0.3)',
                            'rgba(54, 162, 235, 0.3)',
                            'rgba(75, 0, 215, 0.3)',
                            'rgba(153, 102, 255, 0.3)',
                            'rgba(255, 156, 173, 0.3)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 20, 1)',
                            'rgba(255, 165, 0, 1)',
                            'rgba(255, 225, 0, 1)',
                            'rgba(75, 192, 113, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 0, 215, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 156, 173, 1)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }, plugins: {
                    legend: {
                        display: false
                    }
                }
            }
            });

            let graphicTypeChart = document.getElementById('graphicTypeChart').getContext('2d');
            let massPopChart2 = new Chart(graphicTypeChart, {

            type: 'doughnut',
            data: {
                labels: ['Exam Announcement Letter', 'Test Specification Table', 'Examination Question Script', 'Answer Scheme','Endorsed Result','Appointment Letter','Syllabus','Scheme of Work'],
                datasets: [
                    {
                        data: [<?php echo $ealnoSubmit ?>, <?php echo $tstnoSubmit ?>, <?php echo $eqsnoSubmit ?>, <?php echo $ansnoSubmit ?>, <?php echo $ernoSubmit ?>, <?php echo $alnoSubmit ?>, <?php echo $syllabusnoSubmit ?>, <?php echo $sownoSubmit ?>],
                        backgroundColor: [
                            'rgba(255, 0, 20, 0.3)',
                            'rgba(255, 165, 0, 0.3)',
                            'rgba(255, 225, 0, 0.3)',
                            'rgba(75, 192, 113, 0.3)',
                            'rgba(54, 162, 235, 0.3)',
                            'rgba(75, 0, 215, 0.3)',
                            'rgba(153, 102, 255, 0.3)',
                            'rgba(255, 156, 173, 0.3)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 20, 1)',
                            'rgba(255, 165, 0, 1)',
                            'rgba(255, 225, 0, 1)',
                            'rgba(75, 192, 113, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 0, 215, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 156, 173, 1)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }, plugins: {
                    legend: {
                        display: false
                    }
                }
            }
            });
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>