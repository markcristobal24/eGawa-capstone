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

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelancers_hub.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Freelancers Hub</title>

    <style>

    </style>

</head>

<body>

    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>


    <div class="container">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary mt-4" id="navbar_">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="#">Freelancers</a>
                    <button class="navbar-toggler text-white btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Highest</a></li>
                                    <li><a class="dropdown-item" href="#">Lowest</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li> -->
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container d-flex flex-wrap justify-content-center">

            <!-- <div class="box"> -->
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
                        <!-- <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span> -->
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
                        <!-- <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span> -->
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
                        <!-- <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span> -->
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
                        <!-- <span class="fw-light">Sulok Bagna, Malolos, Bulacan</span> -->
                        <small>Sulok Bagna, Malolos, Bulacan</small>
                    </div>
                </div>

                <div class="">
                    <button class="btn btn-outline-info rounded-pill container">View Profile</button>
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
        <script src="../js/user.js"></script>
        <script src="../classJS/Account.js"></script>

        <script src="../classJS/Notification.js"></script>
        <script src="../classJS/Posts.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>