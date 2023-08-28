<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userRegistration.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>eGawa | User Registration</title>

</head>

<body>
    <div class="toast_notif" id="toast_notif"></div>
    

    <div class="containerRegis">
        <form id="account_form" method="POST">
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
                    <label id="mName" for="middleName">Enter Middle Name</label>
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
                    <label id="pass1Label" for="pass1">Enter Password</label>
                </div>

                <div class="form-floating mb-3 col-6 g-2">
                    <input type="password" id="pass2" class="form-control" name="password2"
                        placeholder="Re-enter Password">
                    <label id="pass2Label" for="pass2">Re-enter Password</label>
                </div>
                <div>
                    <input type="checkbox" name="checkboxName" id="checkboxId" value="checkboxValue">
                    <label class="" for="checkboxId"><span id="termsTitle">I agree to the </span></label>
                    <span class="termsTitle" href="" id="tAndC"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">terms and
                        conditions</span>
                </div>

            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                <button type="button" id="btnUserReg" class="btn btn-primary" onclick="new Account().user_register();">
                    Register
                </button>
                <button id="btnUserRegClear" class="btn btn-secondary" onclick="clearFields()">Clear</button>
            </div>
            <hr>
            <p class="infoUserReg">Already have an account? <a id="loginLink" href="login.php">Login here</a></p>
        </form>
    </div>

    <div class="custom-shape-divider-bottom-1690684253">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                opacity=".25" class="shape-fill"></path>
            <path
                d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                opacity=".5" class="shape-fill"></path>
            <path
                d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                class="shape-fill"></path>
        </svg>
    </div>


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


    <!-- Modal For Terms n Condition -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <!-- <div class="modal-dialog"> -->
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Terms and Conditions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at posuere ligula.
                Phasellus vitae dolor ac odio euismod facilisis.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
            </div>
        </div>
    </div>

    






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="../js/user.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/validate.js"></script>

</body>

</html>