<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "freelancer") {
    header('location: ../freelance/userHome.php');
    die();
}
$db = new DbClass();

$company_id = $_GET['company_id'];
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = " . $company_id . " ");
$query->execute();
$fetch = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/view_user_profile.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | <?php echo $fetch['firstName'] . ' ' . $fetch['lastName']; ?></title>

</head>

<body>

    <?php include "../other/navbar.php"; ?>

    <div class="containerUserHome">

        <div class="div2">
            <div class="nav-top"> </div>
            <h2 class="userHistoryTitle"><span><?php echo $fetch['firstName'] . ' ' . $fetch['lastName']; ?>'s</span>
                Transaction History</h2>
            <div class="containerHistory">

                <table class="table table-striped table-light table-hover">
                    <tr>
                        <th>Freelancer</th>
                        <th>Date</th>
                        <th>Info</th>
                    </tr>
                    <?php
                    $query = $db->connect()->prepare("SELECT * FROM job_application
                    INNER JOIN account on  job_application.freelance_id = account.account_id WHERE job_application.user_id = :user_id AND job_application.jobstatus = :status ORDER BY job_application.timestamp DESC");
                    $query->execute([
                        ':user_id' => $company_id,
                        ':status' => 'COMPLETED',
                    ]);
                    $first = true;
                    foreach ($query as $row) {
                        $currentDateTime = $row['timestamp'];
                        $dateTimeObj = new DateTime($currentDateTime);
                        $posted_date = $dateTimeObj->format("F d, Y");
                        $class = $first ? 'table-group-divider' : '';
                        echo '
                        <tr class="' . $class . '">
                            <td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>
                            <td>' . $posted_date . '</td>
                            <td>Completed</td>
                        </tr>
                        ';
                        $first = false;
                    }
                    ?>



                </table>
            </div>
        </div>

        <div class="div1">
            <img id="userPic" src="../img/uploads/company/<?php echo $fetch['user_image']; ?>" alt="user profile"
                title="user profile">
            <h2 id="userName">
                <?php echo $fetch['firstName'] . ' ' . $fetch['lastName']; ?>
            </h2>
            <!-- <div id="verifyUserAcc">Verify Account</div> -->
            <div id="view-dashboard" class="" data-bs-toggle="modal" data-bs-target="#view_dashboard">View Dashboard
            </div>


            <div class="flexDiv">
                <img src="../img/address.png" alt="" class="addressImg" height="20px">
                <div class="freelanceAddress">
                    <?php echo $fetch['barangay'] . ', ' . $fetch['municipality'] . ', ' . $fetch['province']; ?>
                </div>
            </div>
            <div class="flexDiv flexDivBot">
                <img src="../img/email.png" alt="" class="emailImg" height="20px">
                <div class="freelanceEmail">
                    <?php echo $fetch['email']; ?>
                </div>
            </div>
        </div>
    </div>

    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalLogOutConfirmation">
                    <!-- Updated ID -->
                    <!-- ...modal content for log out confirmation -->
                    Are you sure you want to log out?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="logoutBtn">
                            Log Out
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelLogOutBtn">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for view dashboard-->
    <div class="modal fade" id="view_dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <span><?php echo $fetch['firstName'] . ' ' . $fetch['lastName']; ?>'s</span> Profile
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-view-more">
                        <div class="modal-pic-container">
                            <img id="userPic" src="../img/uploads/company/<?php echo $fetch['user_image']; ?>"
                                alt="user profile" title="user profile">
                        </div>

                        <div class="modal-name-container">
                            <p id="userName">
                                <?php echo $fetch['firstName'] . ' ' . $fetch['lastName']; ?>
                            </p>
                        </div>

                        <p id="freelanceUsername">
                            <?php echo "@" . $fetch['username']; ?>
                        </p>

                        <div class="flexDiv">
                            <img src="../img/address.png" alt="" class="addressImg" height="20px">
                            <div class="freelanceAddress marg">
                                <?php echo $fetch['barangay'] . ', ' . $fetch['municipality'] . ', ' . $fetch['province']; ?>
                            </div>
                        </div>

                        <div class="flexDiv">
                            <img src="../img/email.png" alt="" class="emailImg" height="20px">
                            <div class="freelanceEmail marg">
                                <?php echo $fetch['email']; ?>
                            </div>
                        </div>

                        <div>
                            <div id="" class="titles">
                                Dashboard:
                            </div>
                            <div class="box-">
                                <div class="box-1 boxes">
                                    <span>Posted Jobs:</span>
                                    <span class="boxes-data" id="total_posts">100</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Accepted:</span>
                                    <span class="boxes-data" id="total_accepted">60</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Declined:</span>
                                    <span class="boxes-data" id="total_declined">40</span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/script.js "></script>
    <script src="../classJS/Dashboard.js"></script>
    <script src="../js/user.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    new Dashboard().get_information_company_freelancerpov(<?php echo $company_id; ?>);
    </script>



</body>


</html>