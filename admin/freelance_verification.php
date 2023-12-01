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
    <link rel="stylesheet" href="freelance_verification.css" />
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Admin Verification</title>
</head>

<body>

    <?php include "admin-navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>

    <div class="container- mt-5 pt-2">
        <div class="content">
            <div class="container bg-info bg-opacity-10 border border-success border rounded mt-5">
                <div class="row">
                    <div class="parent">
                        <h1>Pending Verification</h1>
                        <div class="child">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">ID Type</th>
                                        <th scope="col">ID Number</th>
                                        <th scope="col">Front ID</th>
                                        <th scope="col">Back ID</th>
                                        <th scope="col">User Type</th>
                                        <th scope="col" class="d-flex">
                                            <span>Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $db->connect()->prepare("SELECT * FROM id_verification INNER JOIN account ON id_verification.account_id = account.account_id WHERE verify_status = :status ORDER BY id_verification.id ASC");
                                    $query->execute([':status' => 'PENDING']);
                                    foreach ($query as $row) {
                                        $id = $row['id'];
                                        $currentDateTime = $row['timestamp'];
                                        $dateTimeObj = new DateTime($currentDateTime);
                                        $date_submitted = $dateTimeObj->format("m-d-Y");
                                        echo '
                                        <tr>
                                            <th scope="row">' . $id . '</th>
                                            <td>' . $row['firstName'] . '</td>
                                            <td>' . $row['lastName'] . '</td>
                                            <td>' . $date_submitted . '</td>
                                            <td>' . $row['id_type'] . '</td>
                                            <td>' . $row['id_number'] . '</td>
                                            <td><a href="../img/uploads/freelancer/id/' . $row['front_image'] . '""><img src = "../img/uploads/freelancer/id/' . $row['front_image'] . '" style = "height: 100px;"></a></td>
                                            <td><a href="../img/uploads/freelancer/id/' . $row['back_image'] . '""><img src = "../img/uploads/freelancer/id/' . $row['back_image'] . '" style = "height: 100px;"></a></td>
                                            <td>' . $row['user_type'] . '</td>
                                            <td>
                                                <button type="button" id="btn_acceptverify" class="btn btn-primary" onclick="new Admin().accept_idverify(' . $id . ');">Accept</button>
                                                <button type="button" id="btn_denyverify" class="btn btn-secondary" onclick="new Admin().deny_idverify(' . $id . ');">Decline</button>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                    <!-- <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                        <th scope="row">1</th>
                                        <td>Arvin</td>
                                        <td>Bok</td>
                                        <td>04-19-20</td>
                                        <td><a href="#">View ID</a></td>
                                        <td>
                                            <button class="btn btn-primary">Accept</button>
                                            <button class="btn btn-secondary">Decline</button>
                                        </td>
                                    </tr>

                                    <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                        <th scope="row">2</th>
                                        <td>John Paulo</td>
                                        <td>Sulit</td>
                                        <td>12-25-19</td>
                                        <td><a href="#">View ID</a></td>
                                        <td>
                                            <button class="btn btn-primary">Accept</button>
                                            <button class="btn btn-secondary">Decline</button>
                                        </td>
                                    </tr>

                                    <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                        <th scope="row">2</th>
                                        <td>Mark Josh</td>
                                        <td>Cristobal</td>
                                        <td>06-07-21</td>
                                        <td><a href="#">View ID</a></td>
                                        <td>
                                            <button class="btn btn-primary">Accept</button>
                                            <button class="btn btn-secondary">Decline</button>
                                        </td>
                                    </tr>

                                    <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                        <th scope="row">2</th>
                                        <td>Joel</td>
                                        <td>Leonor</td>
                                        <td>03-14-21</td>
                                        <td><a href="#">View ID</a></td>
                                        <td>
                                            <button class="btn btn-primary">Accept</button>
                                            <button class="btn btn-secondary">Decline</button>
                                        </td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Admin.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>