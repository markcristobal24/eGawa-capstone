<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "user") {
    header('location: ../freelance/freelanceHome.php');
    die();
}

$db = new DbClass();

$user_id = $_SESSION['account_id'];
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
$query->execute([':account_id' => $user_id]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/user_home.css">
    <link rel="stylesheet" href="../css/notification.css">
    <script src="../classJS/Account.js"></script>
    <!-- For social icons in the footer -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Freelancers Hub</title>

    <style>

    </style>

</head>

<body>

    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>


    <div class="container-fluid d-inline d-sm-flex mt-4 px-1 px-sm-5">

        <div class="container div-left-freelance overflow-y-auto col-lg-6">

            <div class="container div-left-navbar">
                <nav class="navbar bg-body-tertiary rounded-top nav_">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 text-white">Top Rated Freelancers</span>
                    </div>
                </nav>
            </div>


            <div class="container d-flex flex-wrap middle_">
                <?php
                $query = $db->connect()->prepare("SELECT * FROM account 
                INNER JOIN profile ON profile.account_id = account.account_id 
                INNER JOIN reviews ON reviews.freelancer_id = account.account_id 
                WHERE account.userType = 'freelancer' AND (account.ban_status != 'banned' AND account.checkmark != '') 
                ORDER BY AVG(reviews.rating) DESC");
                $query->execute();

                foreach ($query as $row) {
                    echo '
                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">
                        <img src="../img/uploads/freelancer/' . $row['imageProfile'] . '" alt="" class="rounded rounded-circle mt-2">
                        <div class="my-2">'; ?>

                <script>
                new Account().fetch_ratings_freelancer(<?php echo $row['account_id'] ?>)
                </script>
                <?php
                    echo '
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <span>(<span id="total_review"></span>)</span>
                        </div>
                        
                        <div class="container info_ mt-1 justify-content-between">
                            <span class="fw-semibold">' . $row['firstName'] . ' ' . $row['lastName']  . $row['checkmark'] . '</span>
                            <small class="text-info">@' . $row['username'] . '</small>
                        </div>
                        <div class="container">
                            <small>' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . '</small>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container" value="' . $row['account_id'] . '" onclick="view_profile(this.value)">View Profile</button>
                    </div>
                </div>
                ';
                }
                ?>
                <!-- <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">

                        <img src="../img/test.jpg" alt="" class="rounded rounded-circle mt-2">
                        <div class="my-2">
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="container info_ mt-1 justify-content-between">

                            <span class="fw-semibold">Ryomen Sukuna</span>
                            <small class="text-info">@suku_na</small>
                        </div>
                        <div class="container">
                            <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span>
                            <small>Sulok Bagna, Malolos, Bulacan</small>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container">View Profile</button>
                    </div>
                </div>

                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">

                        <img src="../img/test.jpg" alt="" class="rounded rounded-circle mt-2">
                        <div class="my-2">
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="container info_ mt-1 justify-content-between">

                            <span class="fw-semibold">Ryomen Sukuna</span>
                            <small class="text-info">@suku_na</small>
                        </div>
                        <div class="container">
                            <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span>
                            <small>Sulok Bagna, Malolos, Bulacan</small>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container">View Profile</button>
                    </div>
                </div>

                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">

                        <img src="../img/test.jpg" alt="" class="rounded rounded-circle mt-2">
                        <div class="my-2">
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="container info_ mt-1 justify-content-between">

                            <span class="fw-semibold">Ryomen Sukuna</span>
                            <small class="text-info">@suku_na</small>
                        </div>
                        <div class="container">
                            <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span>
                            <small>Sulok Bagna, Malolos, Bulacan</small>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container">View Profile</button>
                    </div>
                </div>

                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">

                        <img src="../img/test.jpg" alt="" class="rounded rounded-circle mt-2">
                        <div class="my-2">
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                            <i class="fas fa-star main_star" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="container info_ mt-1 justify-content-between">

                            <span class="fw-semibold">Ryomen Sukuna</span>
                            <small class="text-info">@suku_na</small>
                        </div>
                        <div class="container">
                            <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span>
                            <small>Sulok Bagna, Malolos, Bulacan</small>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container">View Profile</button>
                    </div>
                </div> -->

            </div>


        </div>

        <div class="container div-right-post col-lg-6">

            <div class="container div-left-navbar">
                <nav class="navbar bg-body-tertiary rounded-top nav_">
                    <div class="container-fluid">
                        <!-- <a class="navbar-brand">Job Post</a> -->
                        <span class="navbar-brand mb-0 h1 text-white">Job Post</span>
                        <!-- <button class="btn btn-success rounded-pill" type="submit">Add Post</button> -->
                    </div>
                </nav>
            </div>

            <div class="container d-flex flex-wrap">

                <!-- FOR ADDING JOB POSTS  -->
                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">
                        <span class="fw-semibold text-info">Add Job post</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-file-circle-plus add-job-icon" style="color: #4665af;"></i>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container" data-bs-toggle="modal"
                            data-bs-target="#add-job-post">Add Job Post</button>
                    </div>
                </div>


                <!-- SAMPLE JOB POST BOI -->
                <div class="box d-flex flex-column justify-content-between m-3 border">
                    <div class="mb-2">

                        <div>
                            <span class="fw-semibold">JOB TITLE</span>
                        </div>

                        <div class="container info_ mt-1">

                            <span class="fw-semibold">01-10-23</span>

                        </div>
                        <div class="container">

                            <small>Sulok Bagna, Malolos, Bulacan</small>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn btn-outline-info rounded-pill container" data-bs-toggle="modal"
                            data-bs-target="#edit-post-modal">View Job Post</button>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- MODAL FOR ADDING JOB POST -->
    <div class="modal fade" id="add-job-post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <!-- <div class="modal fade" id="add-job-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Job Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="post_form" method="POST">

                        <div class="toFlex mx-5 my-3">
                            <div class="dropdownOptionPost">
                                <!-- <select id="filterOptionPost" name="post_category">
                                    <option value="Website Development">Website Development</option>
                                    <option value="Mobile Development">Mobile Development</option>
                                    <option value="Website Hosting">Website Hosting</option>
                                    <option value="Multimedia">Multimedia</option>
                                </select> -->
                                <select id="filterOptionPost" class="form-select" aria-label="Default select example">
                                    <option value="Website Development">Website Development</option>
                                    <option value="Mobile Development">Mobile Development</option>
                                    <option value="Website Hosting">Website Hosting</option>
                                    <option value="Multimedia">Multimedia</option>
                                </select>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Job Title</span>
                            <input type="text" id="title" name="post_title" placeholder="Add Job title"
                                class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1" required>
                        </div>

                        <!-- <div class="descContainer">
                            <textarea id="description" placeholder="Job Description" name="post_description"></textarea>
                        </div> -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">Job Description</span>
                            <textarea id="description" class="form-control" aria-label="With textarea"
                                placeholder="Add Job Description" name="post_description"></textarea>
                        </div>

                        <!-- <input type="text" id="tags" name="post_tags" placeholder="Tags" required> -->

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Tags</span>
                            <input type="text" id="tags" name="post_tags" placeholder="Add Tags" class="form-control"
                                placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="rateInput input-group mb-3 mt-2">

                            <span class="input-group-text">&#8369;</span>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                name="rate" placeholder="Enter rate" required>
                            <span class="input-group-text">.00</span>
                        </div>

                        <div class="btns d-flex flex-row justify-content-end">
                            <button id="submitPost" class="btn btn-primary ms-1" type="button" value="Submit"
                                onclick="new Posts().post();">Submit</button>
                            <button id="clearPost" class="btn btn-secondary ms-1" type="button"
                                value="Clear">Clear</button>
                        </div>
                    </form>
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
                            <!-- <select id="filterOptionPost" name="new_post_category">
                                <option value="Website Development">Website Development</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Website Hosting">Website Hosting</option>
                                <option value="Multimedia">Multimedia</option>
                            </select> -->

                            <select id="filterOptionPost" name="new_post_category" class="form-select"
                                aria-label="Default select example">
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
                                name="new_post_description" placeholder="Edit job description"></textarea>
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




    <script>
    // JavaScript to make the textarea auto-resize
    //     const textarea = document.getElementById('description');

    //     textarea.addEventListener('input', () => {
    //         textarea.style.height = 'auto'; // Reset height to auto
    //         textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scrollHeight
    //     });
    // 
    </script>


    <script src="../js/script.js "></script>
    <script src="../php/messaging/user-side/Message.js"></script>
    <script src="../js/user.js"></script>
    <!-- <script src="../classJS/Account.js"></script> -->

    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Posts.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>