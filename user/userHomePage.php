<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
$db = new DbClass();
if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "user") {
    header('location: ../freelance/freelanceHome.php');
    die();
}
$user_id = $_SESSION['account_id'];
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
$query->execute([':account_id' => $user_id]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userHomePage.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | User Homepage</title>

</head>

<body>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>
    <div class="containerUserHome">

        <div class="div2">
            <div class="nav-top"> </div>
            <h2 class="userHistoryTitle">Your Transaction History</h2>
            <div class="containerHistory">

                <table class="table table-striped table-light table-hover">
                    <tr>
                        <th>Freelancer</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $query = $db->connect()->prepare("SELECT * FROM job_application
                    INNER JOIN account on  job_application.freelance_id = account.account_id WHERE job_application.user_id = :user_id AND job_application.jobstatus = :status ORDER BY job_application.timestamp DESC");
                    $query->execute([
                        ':user_id' => $_SESSION['account_id'],
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
                            <td>' . $row['firstName'] . ' ' . $row['lastName'] . $row['checkmark'] . '</td>
                            <td>' . $posted_date . '</td>
                            <td>Completed</td>
                        </tr>
                        ';
                        $first = false;
                    }
                    ?>
                    <!-- <tr class="table-group-divider">

                        <td>Arvin Candelaria Bok</td>
                        <td>01/01/20</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>Mark Josh Cristobal</td>
                        <td>04/20/21</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>Joel Leonor</td>
                        <td>07/14/22</td>
                        <td>Completed</td>
                    </tr> -->
                    <!-- <tr>
                        <td>Johnny Santos</td>
                        <td>02/14/69</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>Johnny Santos</td>
                        <td>02/14/69</td>
                        <td>Completed</td>
                    </tr> -->

                </table>
            </div>
        </div>

        <div class="div1">
            <?php
            if (isset($_SESSION['user_image'])) {
            ?>
            <img id="userPic" src="../img/uploads/company/<?php echo $_SESSION['user_image']; ?>" alt="user profile"
                title="user profile">
            <?php
            } else {
            ?>
            <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">
            <?php
            }
            ?>

            <h2 id="userName">
                <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . $fetch['checkmark']; ?>
            </h2>
            <p class="user-name">
                @
                <?php echo $_SESSION['username']; ?>
            </p>
            <!-- <div id="verifyUserAcc">Verify Account</div> -->
            <div id="verifyUserAcc" data-bs-toggle="modal" data-bs-target="#view_dashboard">View Dashboard</div>
            <!-- <div id="verifyUserAcc"><a href="../id_verification.php" class=" text-decoration-none text-white mt-1">Verify Account</a></div> -->


            <div class="flexDiv">
                <img src="../img/address.png" alt="" class="addressImg" height="20px">
                <div class="freelanceAddress">
                    <?php echo $_SESSION['barangay'] . ', ' . $_SESSION['municipality'] . ', ' . $_SESSION['province'];; ?>
                </div>
            </div>
            <div class="flexDiv flexDivBot">
                <img src="../img/email.png" alt="" class="emailImg" height="20px">
                <div class="freelanceEmail">
                    <?php echo $_SESSION['email']; ?>
                </div>
            </div>
        </div>
    </div>


    <!--Modal for user account verification-->
    <div class="modal fade" id="modaluserIdVerification" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>User verification</h3>
                </div>

                <div class="imgUpl1">
                    <label class="labelImage" for="uploadInput">Upload 1(one) Valid ID</label>
                    <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                        <img id="uploadedImageUser" src="../img/upload.png" alt="Uploaded Image" height="200">
                    </div>
                    <div>
                        <input id="uploadedImageUser1" type="file" accept="image/*" onchange="loadImageUser(event)"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitUserID">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" id="clearUserID" onclick="clearUserID()">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal for USER EDIT ACCOUNT-->
    <div class="modal fade" id="staticBackdropYow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mt-5">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data" required>
                        <div id="imgUpl">
                            <label class="labelImage" for="uploadInput">Upload New Profile Picture</label>
                            <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                                <img id="uploadedImageCatalog" src="../img/upload.png" alt="Uploaded Image"
                                    height="200">
                            </div>
                            <input id="uploadInput" type="file" name="catalogImg" accept="image/*"
                                onchange="catalogImgUp(event)">
                        </div>

                        <div class="form-floating mb-3 col-11 gx-2 gy-2 mx-auto">
                            <!-- Gap on all sides is 2 -->
                            <input type="text" id="catalogTitle" name="catalogTitle" class="form-control"
                                placeholder="Address">
                            <label id="catalogTitleLabel" for="companyName">Address</label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Clear</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for view dashboard-->
    <div class="modal fade" id="view_dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span
                            class="text-primary"><?php echo $fullname; ?></span><span>'s</span> Dashboard</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-view-more">
                        <!-- DASHBOARD -->
                        <div>
                            <div id="" class="titles text-primary">
                                Dashboard:
                            </div>
                            <div class="box- justify-content-center">
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

                        <!-- USER POSTS -->
                        <!-- <div id="" class="titles mt-4 mb-2">
                            <span class="text-primary titles">Posted Jobs:</span>
                        </div> -->
                        <div class="list-group">
                            <?php
                            // $query = $db->connect()->prepare("SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id WHERE jobposts.account_id = :account_id AND jobposts.post_status != :status ORDER BY jobposts.posted_date DESC");
                            // $query->execute([':status' => 'ARCHIVED', ':account_id' => $_SESSION['account_id']]);
                            // foreach ($query as $row) {
                            //     $currentDateTime = $row['posted_date'];
                            //     $dateTimeObj = new DateTime($currentDateTime);
                            //     $posted_date = $dateTimeObj->format("F d, Y h:i A");

                            //     echo '
                            //     <button type="button" class="list-group-item list-group-item-action">
                            //         <div class="d-flex">
                            //             <div class="p-2 flex-grow-1">' . strtoupper($row['post_title']) . '</div>
                            //             <div class="p-2 date-posted fw-light fst-italic">' . $posted_date . '</div>
                            //             <div class="p-2 border border-primary rounded ms-3" data-bs-toggle="modal" data-bs-target="#edit-post-modal" onclick="new Posts().fetch_jobposts(' . $row['post_id'] . ');">Edit</div>
                            //         </div>
                            //     </button>
                            //     ';
                            // }
                            ?>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR EDIT POST MODAL-->
    <div class="modal fade" id="edit-post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editpost_form" method="POST">
                    <div class="toFlex d-flex justify-content-center p-3">
                        <div class="dropdownOptionPost">
                            <select id="filterOptionPost" name="new_post_category">
                                <option value="Website Development">Website Development</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Website Hosting">Website Hosting</option>
                                <option value="Multimedia">Multimedia</option>
                            </select>
                        </div>
                    </div>

                    <div class="mx-3 mb-3">
                        <!-- <input type="text" id="title" name="post_title" placeholder="Job Title" required> -->
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Job Title</span>
                            <input type="text" class="form-control" id="post_title" name="new_post_title"
                                placeholder="Edit job title" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                    </div>

                    <div class="descContainer mx-3 mb-3">
                        <!-- <textarea id="description" placeholder="Job Description" name="post_description"></textarea> -->
                        <div class="input-group">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" aria-label="Edit description" id="post_description"
                                name="new_post_description"></textarea>
                        </div>
                    </div>

                    <div class="mx-3 mb-3">
                        <!-- <input type="text" id="tags" name="post_tags" placeholder="Tags" required> -->
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Tag</span>
                            <input type="text" class="form-control" id="post_tags" placeholder="Edit tag"
                                aria-label="Username" name="new_post_tags" aria-describedby="addon-wrapping">
                        </div>
                    </div>

                    <div class="mx-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text">&#8369;</span>
                            <input type="number" class="form-control" id="rate"
                                aria-label="Dollar amount (with dot and two decimal places)" name="new_rate"
                                placeholder="Enter rate">
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>

                    <!-- <div class="btns">
                            <input id="submitPost" class="btn" type="button" value="Submit"
                                onclick="new Posts().post();">
                            <input id="clearPost" class="btn" type="button" value="Clear">
                        </div> -->


                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger"  data-bs-target="#delete-post-modal">Delete</button> -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-modal">Delete</button>
                        <button type="button" class="btn btn-primary" id="btn_editpost"
                            onclick="new Posts().edit_post(this.value);">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CONFIRMATION DELETE POST MODAL -->
    <div class="modal fade" id="delete-post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Post?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-danger" id="btn_deletepost" data-bs-dismiss="modal"
                        onclick="new Posts().delete_post(this.value);">Delete</button>
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


    <script src="../js/script.js "></script>
    <script src="../classJS/Dashboard.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Posts.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../js/user.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <script>
    new Dashboard().get_information_company();
    </script>
</body>


</html>