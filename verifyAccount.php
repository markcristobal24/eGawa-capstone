<?php session_start();
if (!isset($_SESSION["otp"])) {
    header('location: error.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    <!-- Link for CSS -->
    <link rel="stylesheet" href="css/verifyAccount.css" />

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>eGawa | Account Verification</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/eGAWAwhite.png" alt="Logo" id="logoImage" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="home1" class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="about1" id="about" class="nav-link" href="aboutUs.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a id="login1" class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="containerVerify">
        <form action="#" method="post">
            <h1 class="verifyTitle">Verify Account</h1>

            <div class="form-floating mb-3">
                <input type="text" id="verificationCode" name="otp_code" class="form-control"
                    placeholder="Enter verification code" required />
                <label for="text">Enter verification code</label>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary" name="btnVerify" id="btnVerify">
                    Verify
                </button>
            </div>

            <hr />
            <p>
                <span class="infoVerify">Did not received the code?</span>
                <button id="resendLink" href="#" name="resend">Resend code</button>
            </p>
            <div id="message"></div>
        </form>
    </div>

    <div class="custom-shape-divider-bottom-1687514102">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
    </div>


    <footer class="footer">
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
    </footer>

    <!---Modal Verify-->
    <div class="modal fade" id="verifyModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Warning!</h5>
                </div>
                <div class="modal-body" id="modalbody2">Body</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="verifyConfirm">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/validate.js"></script>

</body>

</html>

<?php
include('php/classes/DbConnection.php');
require_once dirname(__FILE__) . '/php/classes/Email.php';
if (isset($_POST["btnVerify"])) {
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
        ?>
        <script>
            invalidOtp();
        </script>
        <?php
    } else {
        mysqli_query($con, "UPDATE account SET status = 1 WHERE email = '$email'");
        ?>
        <script>
            alert('sucess otp');
            window.location.replace("login.php");
        </script>
        <?php
    }
}
?>