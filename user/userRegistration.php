<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userRegistration.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />





    <title>eGawa | User Registration</title>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../img/eGAWAwhite.png" alt="Logo" id="logoImage"></a>
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

            </div>
        </div>
    </nav>

    <div class="containerRegis">
        <form action="controller/c_uRegister.php" method="POST" onsubmit="return validateRegForm()">
            <h1 class="userRegTitle">User Registration</h1>
            <div class="row">
                <!--Each row is based on a 12 column system-->

                <!--For the full name we use 4+4+4 -->
                <div class="form-floating mb-3 col-4 gx-2 gy-2">
                    <input type="text" id="firstName" name="fName" class="form-control" placeholder="Enter First Name">
                    <label id="fName" for="firstName">Enter First Name</label>
                </div>

                <div class="form-floating mb-3 col-4 gx-2 gy-2">
                    <!-- Gap on all sides is 2 -->
                    <input type="text" id="middleName" name="mName" class="form-control"
                        placeholder="Enter Middle Name">
                    <label id="sName" for="middleName">Enter Middle Name</label>
                </div>

                <div class="form-floating mb-3 col-4 gx-2 gy-2">
                    <!-- Gap on all sides is 2 -->
                    <input type="text" id="surName" name="lName" class="form-control" placeholder="Enter Surname">
                    <label id="sName" for="surName">Enter Surname</label>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address">
                    <label id="addr" for="address">Enter Address</label>
                </div>


                <div class="form-floating mb-3 col-6 gx-2 gy-2">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username">
                    <label id="uName" for="username">Enter Username</label>
                </div>

                <div class="form-floating mb-3 col-6 gx-2 gy-2">
                    <input type="email" id="emailAddress" name="email" class="form-control"
                        placeholder="Enter Email Address">
                    <label id="eAdd" for="emailAddress">Enter Email Address</label>
                </div>

                <!--For the password we use 6 -->
                <div class="form-floating mb-3 col-6 g-2">
                    <input type="password" id="pass1" name="password" class="form-control" placeholder="Enter Password">
                    <label id="pass1" for="pass1">Enter Password</label>
                </div>

                <div class="form-floating mb-3 col-6 g-2">
                    <input type="password" id="pass2" class="form-control" placeholder="Re-enter Password">
                    <label id="pass2" for="pass2">Re-enter Password</label>
                </div>

            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                <button type="submit" id="btnUserReg" class="btn btn-primary">
                    Register
                </button>
                <button id="btnUserRegClear" class="btn btn-secondary">Clear</button>
            </div>
            <hr>
            <p class="infoUserReg">Already have an account? <a id="loginLink" href="login.php">Login here</a></p>
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



    <!--Modal for incomplete details-->
    <div class="modal fade" id="modalUserReg" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Warning!</h5>
                </div>
                <div class="modal-body" id="modalUser">Incomplete Details</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="yesReg">
                        Understood
                    </button>
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