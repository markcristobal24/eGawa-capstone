<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "user") {
    header('location: ../freelance/freelanceHome.php');
    die();
}

$db = new DbClass();

$freelance_id = $_GET['freelance_id'];
$_SESSION['freelance_id'] = $freelance_id;
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
$query->execute([':account_id' => $freelance_id]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$stmt = $db->connect()->prepare("SELECT * FROM reviews WHERE application_id = :appId AND company_id = :userId");
$stmt->execute([
    ':appId' => $_SESSION['application_id'],
    ':userId' => $_SESSION['account_id']
]);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />


    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Freelancer's Ratings</title>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/userrating.css">
    <link rel="stylesheet" href="../css/notification.css">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="toast_notif" id="toast_notif"></div>
    <?php include "../other/navbar.php"; ?>

    <div class="container">
        <h1 class="mt-5 mb-5">Review & Rate <span>(<?php echo $fetch['firstName'] . ' ' . $fetch['lastName'] ?>)</span>
        </h1>
        <div class="card">
            <!-- <div class="card-header">Sample Product</div> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <div class="midPosOut">
                            <div class="midPos">
                                <h3 class="titleColor"><span class="titleColor" id="total_review">0</span> Review</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <?php
                    if ($stmt->rowCount() > 0) {
                        echo '';
                    } else {
                        echo '
                            <div class="col-sm-4 text-center" id="review_div">
                        <div id="reviewTitle">
                            <h3 id="reviewTitleInside" class="mt-4 mb-3 titleColor">Write Review Here</h3>
                        </div>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                    </div>
                            ';
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </div>

    <!-- <div class="custom-shape-divider-bottom-1687514102">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
    </div> -->


    <!-- <footer class="footer">
        <div class="containerFooter">
            <div class="socialIcons">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.gmail.com/"><i class="fa-brands fa-google"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <p class="footerInfo">&copy; 2023 eGawa. All rights reserved.</p>
        </div>
    </footer> -->


    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalUser">Are you sure you want to log out?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="logoutBtn" onclick="toLogout();">
                        Log Out
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelLogOutBtn">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Review</h5>
                </div>

                <div class="modal-body">
                    <form id="rating_form" enctype="multipart/form-data">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>

                        <div class="imgUpl1">
                            <label class="labelImage">Upload photo</label>
                            <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">

                                <img id="uploadedImageReview" src="../img/uploadIMG.png" alt="Uploaded Image"
                                    height="200">
                            </div>
                            <div>
                                <input id="review_ss" name="review_ss" type="file" accept="image/*"
                                    onchange="loadImageReview(event)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="freelance_id" value="<?php echo $freelance_id ?>">
                            <!-- <label for="user_name">Your Account Id:</label> -->
                            <input type="hidden" name="user_name" value="<?php echo $_SESSION['account_id'] ?>"
                                id="user_name" class="form-control" placeholder="Enter Your Name" disabled />
                        </div>
                        <div class="form-group">
                            <label for="user_review">Write your review here:</label>
                            <textarea name="user_review" id="user_review" class="form-control"
                                placeholder="Type Review Here"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                            <button type="button" class="btn btn-secondary" id="close_review">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/userrating.js "></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
</body>

</html>