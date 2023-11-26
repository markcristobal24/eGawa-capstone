<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
$db = new DbClass();
if ($_SESSION['userType'] !== "super_admin") {
    header('location: ../login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    <!-- Link for CSS -->
    <link rel="stylesheet" href="job-categories.css" />
    <link rel="stylesheet" href="css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        /* Custom CSS to change button colors */
    </style>

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Job Categories</title>
</head>

<body>
    <div class="toast_notif" id="toast_notif"></div>
    <?php include "admin-navbar.php"; ?>

    <div class="container mt-5 pt-5">

        <div class="p-3 mb-2 bg-secondary d-flex justify-content-between">
            <span class="text-white fs-3">Job Categories</span>
            <a class="btn btn-primary" href="#" target="_blank" role="button" data-bs-toggle="modal" data-bs-target="#add-job-type">Add Category</a>
        </div>

        <div class="d-flex justify-content-between flex-wrap mb-3">
            <!-- Centering container -->

            <!-- <div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div> -->
        </div>


        <div class="tab-content" id="pills-tabContent">
            <!-- TAB FOR FREELANCERS -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="container">
                    <table class="table table-hover border">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">No.</th>
                                <th scope="col">Job Type ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="freelance_tbl">
                            <tr>
                                <th scope="row">1</th>
                                <td>Website Development</td>
                                <td class="text-primary pe-auto">
                                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#view-job-type">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mobile Development</td>
                                <td class="text-primary pe-auto">
                                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#view-job-type">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Website Hosting</td>
                                <td class="text-primary pe-auto">
                                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#view-job-type">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Multimedia</td>
                                <td class="text-primary pe-auto">
                                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#view-job-type">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>


    <!-- Modal for edit or delete -->
    <div class="modal fade" id="view-job-type" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT <span class="text-primary">(PASS YUNG JOB TITLE HERE)</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>

                    </div>
                    <div class="my-3">
                        <form action="">
                            <input class="form-control" type="text" placeholder="(PASS YUNG JOB TITLE HERE)" aria-label="default input example">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for add job category -->
    <div class="modal fade" id="add-job-type" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Job Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <strong>Job Category Title</strong>
                    </div>
                    <div class="my-3">
                        <form action="">
                            <input class="form-control" type="text" placeholder="Enter new job category" aria-label="default input example">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>