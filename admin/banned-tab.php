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
                                    <th scope="col">Ban ID</th>
                                    <th scope="col" class="text-center">Account ID</th>
                                    <th scope="col" class="text-center">Firstname</th>
                                    <th scope="col" class="text-center">Lastname</th>
                                    <th scope="col" class="text-center">Reason</th>
                                    <th scope="col" class="text-center">Date Banned</th>
                                    <th scope="col" class="text-center">User Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $db->connect()->prepare("SELECT * FROM ban_list INNER JOIN account ON account.account_id = ban_list.account_id ORDER BY ban_id");
                                $query->execute();
                                foreach ($query as $row) {
                                    $currentDateTime = $row['date_ban'];
                                    $dateTimeObj = new DateTime($currentDateTime);
                                    $posted_date = $dateTimeObj->format("m-d-Y");

                                    echo '
                                    <tr data-bs-toggle="modal" data-bs-target="#report-info-modal">
                                        <th scope="row">' . $row['ban_id'] . '</th>
                                        <td class="text-center text-danger">' . $row['account_id'] . '</td>
                                        <td class="text-center text-danger">' . $row['firstName'] . '</td>
                                        <td class="text-center text-danger">' . $row['lastName'] . '</td>
                                        <td class="text-center text-danger"><span class="d-inline-block text-truncate" style="max-width: 150px;">' . $row['reason'] .  '</span></td>
                                        <td class="text-center text-danger">' . $posted_date . '</td>
                                        <td class="text-center text-danger">' . $row['userType'] . '</td>
                                    </tr>
                                    ';
                                }
                                ?>
                                <!-- <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">1</th>
                                    <td class="text-center text-danger">Arvin</td>
                                    <td class="text-center  text-danger">Bok</td>
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
                                </tr> -->

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
<div class="modal fade" id="report-info-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply">

                <div>
                    <div class="d-flex justify-content-center">
                        <h3>Arvin Candelaria Bok</h3>
                    </div>
                    <div class="d-flex justify-content-center text-primary">
                        <h4>@vinny</h4>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-1">
                        <span><i class="fa-solid fa-house-user text-primary-emphasis"></i></span>
                        <span class="px-2">Sto.Nino, Hagonoy, Bulacan</span>
                    </div>
                    <div class="d-flex justify-content-center mb-1">
                        <span><i class="fa-solid fa-envelope text-primary-emphasis"></i></span>
                        <span class="px-2">sampleemail@gmail.com</span>
                    </div>
                    <div class="d-flex justify-content-center mb-1">
                        <span class="text-danger">Date Banned: </span>
                        <span class="px-2">04-19-1950</span>
                    </div>
                    <div class=" mb-1">
                        <div>
                            <span class="text-danger mx-5">Reason:</span>
                        </div>
                        <div class="mx-5 px-3">
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis pariatur minus voluptas amet odio minima distinctio in reiciendis soluta placeat.</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ban-confirmation">Ban User</button> -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</html>