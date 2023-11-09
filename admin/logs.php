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
    <link rel="stylesheet" href="logs.css" />
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

    <title>eGawa | Admin Logs</title>
</head>

<body>

    <?php include "admin-navbar.php"; ?>

    <div class="container mt-5 pt-5">

        <div class="p-3 mb-2 bg-secondary d-flex justify-content-between">
            <span class="text-white fs-3">Audit Logs</span>
            <div>
                <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active color-" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Freelance</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link color-" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Company</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link color-" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Messages</button>
                    </li>
                </ul>
                </ul>
            </div>

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
                <div class="d-flex justify-content-end container mb-1">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" id="freelancer_field"
                            placeholder="Search ID, Name, Date" aria-label="Search"
                            onkeyup="new Admin().search_filter(this.value, 'freelancer')">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    </form>
                </div>
                <div class="container">
                    <table class="table table-hover border">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">Event ID</th>
                                <th scope="col">Timestamp</th>
                                <th scope="col">Account ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Event</th>
                            </tr>
                        </thead>
                        <tbody id="freelance_tbl">
                            <?php
                            $query = $db->connect()->prepare("SELECT * FROM activity_logs INNER JOIN account ON account.account_id = activity_logs.account_id WHERE user_type = :type ORDER BY activity_logs.timestamp DESC");
                            $query->execute([':type' => 'freelancer']);

                            foreach ($query as $row) {
                                $currentDateTime = $row['timestamp'];
                                $dateTimeObj = new DateTime($currentDateTime);
                                $timestamp = $dateTimeObj->format("Y-m-d h:i A");

                                echo '
                                <tr>
                                    <th scope="row">' . $row['event_id'] . '</th>
                                    <td>' . $timestamp . '</td>
                                    <td>' . $row['account_id'] . '</td>
                                    <td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>
                                    <td>' . $row['event'] . '</td>
                                </tr>
                                ';
                            }
                            ?>
                            <!-- <tr>
                                <th scope="row">1</th>
                                <td>2020-09-01 09:26</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>2021-06-23 09:26</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>2023-12-29 09:26</td>
                                <td>Larry</td>
                                <td>Bird</td>
                                <td>@twitter</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB FOR COMPANY -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="d-flex justify-content-end container mb-1">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" id="company_field"
                            placeholder="Search ID, Name, Date" aria-label="Search"
                            onkeyup="new Admin().search_filter(this.value, 'company');">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    </form>
                </div>
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="container">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">Event ID</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Account ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Event</th>
                                </tr>
                            </thead>
                            <tbody id="company_tbl">
                                <?php
                                $query = $db->connect()->prepare("SELECT * FROM activity_logs INNER JOIN account ON account.account_id = activity_logs.account_id WHERE user_type = :type OR user_type = :other ORDER BY activity_logs.timestamp DESC");
                                $query->execute([':type' => 'company', ':other' => 'user']);

                                foreach ($query as $row) {
                                    $currentDateTime = $row['timestamp'];
                                    $dateTimeObj = new DateTime($currentDateTime);
                                    $timestamp = $dateTimeObj->format("Y-m-d h:i A");

                                    echo '
                                <tr>
                                    <th scope="row">' . $row['event_id'] . '</th>
                                    <td>' . $timestamp . '</td>
                                    <td>' . $row['account_id'] . '</td>
                                    <td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>
                                    <td>' . $row['event'] . '</td>
                                </tr>
                                ';
                                }
                                ?>
                                <!-- <tr>
                                    <th scope="row">1</th>
                                    <td>2020-09-01 09:26</td>
                                    <td>Jack</td>
                                    <td>Daniels</td>
                                    <td>@edaddy</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2021-06-23 09:26</td>
                                    <td>Boss</td>
                                    <td>Pillos</td>
                                    <td>@egirlhunter</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>2023-12-29 09:26</td>
                                    <td>Mister</td>
                                    <td>Bagna</td>
                                    <td>@lethimcook</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB FOR MESSAGES -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">
                <div class="d-flex justify-content-end container mb-1">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" id="message_field" placeholder="Search ID"
                            aria-label="Search" onkeyup="new Admin().search_filter(this.value, 'message')">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    </form>
                </div>
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="container">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">Message ID</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Sender ID</th>
                                    <th scope="col">Receiver ID</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody id="message_tbl">
                                <?php
                                $query = $db->connect()->prepare("SELECT * FROM messages ORDER BY timestamp DESC");
                                $query->execute();
                                foreach ($query as $row) {
                                    $currentDateTime = $row['timestamp'];
                                    $dateTimeObj = new DateTime($currentDateTime);
                                    $timestamp = $dateTimeObj->format("Y-m-d h:i A");

                                    echo '
                                     <tr>
                                        <th scope="row">' . $row['message_id'] . '</th>
                                        <td>' . $timestamp . '</td>
                                        <td>' . $row['sender_id'] . '</td>
                                        <td>' . $row['receiver_id'] . '</td>
                                        <td>' . $row['message'] . '</td>
                                    </tr>
                                    ';
                                }
                                ?>
                                <!-- <tr>
                                    <th scope="row">1</th>
                                    <td>2020-09-01 09:26</td>
                                    <td>Jack</td>
                                    <td>Daniels</td>
                                    <td>@edaddy</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2021-06-23 09:26</td>
                                    <td>Boss</td>
                                    <td>Pillos</td>
                                    <td>@egirlhunter</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>2023-12-29 09:26</td>
                                    <td>Mister</td>
                                    <td>Bagna</td>
                                    <td>@lethimcook</td>
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>