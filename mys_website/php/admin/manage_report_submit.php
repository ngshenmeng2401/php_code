<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Report Submited</title>
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
                      <li><a class="dropdown-item active" href="manage_report.php">Report</a></li>
                      <li><a class="dropdown-item" href="manage_submission.php">Submission</a></li>
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
                    <a class="nav-link text-light" href="">Logout</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
  
    <!-- Body -->
    <div class="container">
        <div class="row mt-3">
            <div class="col-5 col-sm-4 col-lg-6 col-xxl-8">
                <button class="btn userlist-btn float-end text-light" data-bs-toggle="modal" data-bs-target="#addReportModal">Add Report</button>
            </div>
            <div class="col-7 col-sm-4 col-lg-3 col-xxl-2">
                <a class="btn userlist-btn float-end text-light" href="manage_report_submit.php">User List (Submited)</a>
            </div>
            <div class="col-12 col-sm-4 col-lg-3 col-xxl-2 mt-2 mt-sm-0">
                <a class="btn userlist-btn float-end text-light" href="manage_report_nosubmit.php">User List (No Submit)</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4 px-3 px-sm-0">
            <div class="card shadow mb-4">
                <div class="card-body ">
                    <h1 class="text-center mb-3">User List have Submit</h1>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>Bil.</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Document</th>
                                    <th>Percentage (%)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Steve Nash</td>
                                    <td></td>
                                    <td>STIX 3913 Project 1</td>
                                    <td>A211</td>
                                    <td>{5</td>
                                    <td>55.56</td>
                                    <td>
                                        <i class="bi bi-pencil me-3" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateModal"></i>
                                        <i class="bi bi-trash" style="color: #693D70 ; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addReportModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder=""aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Document</label>
                        <input type="number" class="form-control" id="document" name="document" aria-describedby="emailHelp" required>
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

    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    Are You Sure ?
                    <input type="hidden" class="form-control" id="document" name="document" aria-describedby="emailHelp" required>
                    
                    <input type="hidden" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" required>
                
                    <input type="hidden" class="form-control" id="semester" name="semester" aria-describedby="emailHelp" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning reset-btn" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn userlist-btn text-light">Yes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder=""aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Document</label>
                        <input type="number" class="form-control" id="document" name="document" aria-describedby="emailHelp" required>
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
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>