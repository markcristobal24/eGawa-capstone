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
    <link rel="stylesheet" href="transaction-tab.css" />
    <link rel="stylesheet" href="css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
    /* Custom CSS to change button colors */
    </style>

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Transaction Logs</title>
</head>

<body>
    <div class="toast_notif" id="toast_notif"></div>
    <?php include "admin-navbar.php"; ?>

    <div class="container mt-5 pt-5">

        <div class="p-3 mb-2 bg-secondary d-flex justify-content-between">
            <span class="text-white fs-3">Transaction History</span>
            <a class="btn btn-primary" href="../report.php" target="_blank" role="button">Print</a>
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
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">

                <div class="container">
                    <table class="table table-hover border">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Freelancer Name</th>
                                <th scope="col">Employer Name</th>
                                <th scope="col">Date of Transaction</th>
                            </tr>
                        </thead>
                        <tbody id="freelance_tbl">
                            <?php
                            $query = $db->connect()->prepare("SELECT t.*, CONCAT(a1.firstName, ' ', a1.lastName) AS freelancer_name, CONCAT(a2.firstName, ' ', a2.lastName) AS company_name
                            FROM job_application AS t
                            INNER JOIN account AS a1 ON a1.account_id = t.freelance_id
                            INNER JOIN account AS a2 ON a2.account_id = t.user_id
                            WHERE t.jobstatus = 'COMPLETED'");
                            $query->execute();
                            foreach ($query as $row) {
                                $currentDateTime = $row['timestamp'];
                                $dateTimeObj = new DateTime($currentDateTime);
                                $posted_date = $dateTimeObj->format("m-d-Y");
                                echo '
                                <tr>
                                    <th scope="row">' . $row['transaction_id'] . '</th>
                                    <td>' . $row['freelancer_name'] . '</td>
                                    <td>' . $row['company_name'] . '</td>
                                    <td>' . $posted_date . '</td>
                                </tr>
                                ';
                            }
                            ?>
                            <!-- <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Julit</td>
                                <td>2020-09-01</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Jack</td>
                                <td>2021-06-23</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>Aaron</td>
                                <td>2023-12-29</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="../js/script.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>