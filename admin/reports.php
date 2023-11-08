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
    <link rel="stylesheet" href="reports.css" />
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>eGawa | Admin Reports</title>
    <style>

    </style>
</head>

<body>

    <?php include "admin-navbar.php"; ?>

    <div class="container mt-5 pt-5">

        <div class="p-3 mb-2 bg-secondary text-white fs-3">Reports</div>

        <div class="container">
            <div class="row">
                <div class="parent">
                    <div class="child">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">Report ID</th>
                                    <th scope="col">Account ID</th>
                                    <th scope="col" class="text-center">Firstname</th>
                                    <th scope="col" class="text-center">Lastname</th>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $db->connect()->prepare("SELECT * FROM reports
                                INNER JOIN account ON account.account_id = reports.account_id");
                                $query->execute();

                                foreach ($query as $row) {
                                    $currentDateTime = $row['timestamp'];
                                    $dateTimeObj = new DateTime($currentDateTime);
                                    $date_submitted = $dateTimeObj->format("m-d-Y");
                                    $reporter = $row['firstName'] . ' ' . $row['lastName'];
                                    echo '
                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal" onclick = "new Admin().fetch_report(' . $row['report_id'] . ', \'' . $reporter . '\');">
                                    <th scope="row">' . $row['report_id'] . '</th>
                                    <th scope="row">' . $row['account_id'] . '</th>
                                    <td class="text-center">' . $row['firstName'] . '</td>
                                    <td class="text-center">' . $row['lastName'] . '</td>
                                    <td class="text-center">' . $date_submitted . '</td>';
                                    if ($row['report_status'] == 'PENDING') {
                                        echo '<td class="text-center"><i class="fa-regular fa-circle-xmark" style="color: #e33131;"></i></td>';
                                    } else {
                                        echo '<td class="text-center"><i class="fa-regular fa-circle-check" style="color: #1bd057;"></i></td>';
                                    }

                                    echo '</tr>
                                    ';
                                }
                                ?>

                                <!-- <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">1</th>
                                    <td class="text-center">Arvin</td>
                                    <td class="text-center">Bok</td>
                                    <td class="text-center">04-19-20</td>
                                    <td class="text-center"><i class="fa-regular fa-circle-check"
                                            style="color: #1bd057;"></i></td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">2</th>
                                    <td class="text-center">John Paulo</td>
                                    <td class="text-center">Sulit</td>
                                    <td class="text-center">12-25-19</td>
                                    <td class="text-center"><i class="fa-regular fa-circle-xmark"
                                            style="color: #e33131;"></i></td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">3</th>
                                    <td class="text-center">Mark Josh</td>
                                    <td class="text-center">Cristobal</td>
                                    <td class="text-center">06-07-21</td>
                                    <td class="text-center"><i class="fa-regular fa-circle-xmark"
                                            style="color: #e33131;"></i></td>
                                </tr>

                                <tr data-bs-toggle="modal" data-bs-target="#report-user-modal">
                                    <th scope="row">4</th>
                                    <td class="text-center">Joel</td>
                                    <td class="text-center">Leonor</td>
                                    <td class="text-center">03-14-21</td>
                                    <td class="text-center"><i class="fa-regular fa-circle-xmark"
                                            style="color: #e33131;"></i></td>
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

<!-- Modal For Report Information  -->
<div class="modal fade" id="report-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Report Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply">
                <form id="">
                    <div class="title mb-1">
                        <span class="fw-bold">Submitted By:</span>
                        <span class="text-primary" id="reporter">
                            Lebron James
                        </span>
                    </div>

                    <div class="title mb-1">
                        <span class="fw-bold">Reported Account:</span>
                        <span class="text-danger" id="reported_account">
                            John Paulo Sulitz
                        </span>
                    </div>

                    <div class="title">
                        <span class="label fw-bold">Message:</span>
                        <div class="form-floating mt-1 mb-2 border p-3 rounded ">
                            <span class="" id="reason">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias illo fugit
                                obcaecati? Nemo magni esse est,
                                eaque nulla, nesciunt ipsam labore reiciendis itaque, explicabo soluta. Id magni fugit
                                suscipit,
                                possimus veritatis ut excepturi inventore eius quo quam, consequatur voluptas iusto
                                dolores porro perferendis aut qui quos dignissimos sequi cum?
                                Alias culpa dolore recusandae porro assumenda nostrum dolores dicta numquam consectetur
                                voluptatum repellendus eveniet officia velit accusamus
                                tenetur laborum vitae minus et, iure excepturi dolorem! Veniam asperiores quo architecto
                                sapiente recusandae nisi iure omnis dicta eius, minima,
                                cum provident accusamus ratione earum distinctio unde quaerat. Commodi nostrum illo quia
                                minima dolorum similique, quibusdam dignissimos dolorem,
                                placeat odit distinctio corporis earum numquam ratione laudantium doloribus ut eveniet
                                asperiores vel sunt mollitia. Animi consequatur molestiae
                                nulla minima tempora, eligendi tempore libero nam cumque et quasi totam voluptas ea
                                magnam culpa a nihil labore accusantium, cupiditate autem.
                                Omnis blanditiis numquam maxime ab id assumenda exercitationem, magni sint corporis
                                earum accusantium vel neque temporibus aspernatur pariatur
                                dicta maiores, perferendis eaque accusamus hic. Tenetur, maxime in placeat error veniam
                                laudantium hic eum nisi minus sapiente possimus
                                corrupti temporibus cumque amet. Nisi dolores et perferendis, temporibus aperiam
                                explicabo provident praesentium cum repellendus impedit ducimus,
                                fuga, ad rerum!
                            </span>
                        </div>
                    </div>

                    <label for="formFileSm" class="form-label label fw-bold ">Uploaded file</label>
                    <div class="mb-3 d-flex justify-content-center">
                        <!-- <input class="form-control form-control-sm" name="apply_file" id="formFileSm" type="file"> -->
                        <img src="../img/egawaicon4.png" id="screenshot" class="img-fluid" alt="...">
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="" class="btn btn-primary">Done</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</html>