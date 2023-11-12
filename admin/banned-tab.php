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
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Link for CSS -->
    <link rel="stylesheet" href="company-tab.css" />
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>eGawa | Banned Users</title>
    <style>

    </style>
</head>

<body>

    <?php include "admin-navbar.php"; ?>

    <div class="container mt-5 pt-5">

        <div class="p-3 mb-2 bg-secondary text-white fs-3">Banned Users</div>

        <div class="container">
            <div class="row">
                <div class="parent">
                    <div class="child">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-center">Firstname</th>
                                    <th scope="col" class="text-center">Lastname</th>
                                    <th scope="col" class="text-center">Date Banned</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">1</th>
                                    <td class="text-center text-danger">Arvin</td>
                                    <td class="text-center text-danger">Bok</td>
                                    <td class="text-center">04-19-20</td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">2</th>
                                    <td class="text-center text-danger">John Paulo</td>
                                    <td class="text-center text-danger">Sulit</td>
                                    <td class="text-center">12-25-19</td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">3</th>
                                    <td class="text-center text-danger">Mark Josh</td>
                                    <td class="text-center text-danger">Cristobal</td>
                                    <td class="text-center">06-07-21</td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">4</th>
                                    <td class="text-center text-danger">Joel</td>
                                    <td class="text-center text-danger">Leonor</td>
                                    <td class="text-center">03-14-21</td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">4</th>
                                    <td class="text-center text-danger">Ryomen</td>
                                    <td class="text-center text-danger">Sukuna</td>
                                    <td class="text-center">06-20-22</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
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

<!-- Modal For Company Information  -->
<div class="modal fade" id="report-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel"><span class="text-primary">Arvin</span><span>'s</span> Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply">


                <div class="d-flex justify-content-center">
                    <div class="border border-success-subtle rounded-circle">
                        <img src="../img/uploadIMG.png" alt="" class="rounded-circle p-1 w-10" style="width: 150px; height: 150px;">
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-center">
                        <h3>Arvin Candelaria Bok</h3>
                        <span>
                            <!-- place verified icon here -->
                        </span>
                    </div>
                    <div class="d-flex justify-content-center text-primary">
                        <h4>@vinny</h4>
                    </div>
                    <div class="d-flex justify-content-center">

                        <span class="fs-5 fw-3">
                            Status:
                        </span>

                        <!-- IF THE USER IS NOT BANNED SHOW THIS CODE  -->
                        <span class="fs-5 fw-2 text-success px-2">
                            Authorized
                        </span>

                        <!-- IF THE USER IS BANNED SHOW THIS INSTEAD OF THE CODE ABOVE -->
                        <!-- <span class="fs-5 fw-2 text-danger px-2">
                            Banned
                        </span> -->

                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-1">
                        <span><i class="fa-solid fa-house-user text-primary-emphasis"></i></span>
                        <span class="px-2">Sto.Nino, Hagonoy, Bulacan</span>
                    </div>
                    <div class="d-flex justify-content-center mb-1">
                        <span><i class="fa-solid fa-envelope text-primary-emphasis"></i></span>
                        <span class="px-2">sampleemail@gmail.com</span>
                    </div>
                    <div class="d-flex justify-content-center mb1">
                        <span class="text-primary-emphasis">Date Started: </span>
                        <span class="px-2">04-19-1950</span>
                    </div>
                </div>

                <!-- START OF DASHBOARD -->
                <div class="text-primary">
                    <hr>
                </div>

                <div clas="d-flex justify-content-start">
                    <h1 class="fw-bold fs-5">Dashboard:</h1>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="box-">
                        <div class="box-1 boxes">
                            <span>Application:</span>
                            <span class="boxes-data">100</span>
                        </div>
                        <div class="box-2 boxes">
                            <span>Accepted:</span>
                            <span class="boxes-data">60</span>
                        </div>
                        <div class="box-3 boxes">
                            <span>Declined:</span>
                            <span class="boxes-data">40</span>
                        </div>
                    </div>
                </div>
                <!-- END OF DASHBOARD -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ban-confirmation">Ban User</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- BAN USER CONFIRMATION MODAL -->
<div class="modal fade" id="ban-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger fw-bold fs-5">Ban User?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to ban <span>Arvin?</span> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Ban</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

</html>