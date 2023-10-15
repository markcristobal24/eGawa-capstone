<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userHomePage.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | User Homepage</title>

</head>

<body>

    <?php include "../other/navbar.php"; ?>

    <div class="containerUserHome">

        <div class="div2">
            <div class="nav-top"> </div>
            <h2 class="userHistoryTitle">Your Transaction History</h2>
            <div class="containerHistory">

                <table class="table table-striped table-light table-hover">
                    <tr>
                        <th>Freelancer</th>
                        <th>Date</th>
                        <th>Info</th>
                    </tr>

                    <tr class="table-group-divider">
                        <!-- Adds horizontal line, can be used on any row-->
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
                    </tr>
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
            <img id="userPic" src="../img/uploads/company/<?php echo $_SESSION['user_image']; ?>" alt="user profile"
                title="user profile">
            <h2 id="userName">
                <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?>
            </h2>
            <p class="user-name">
                @
                <?php echo $_SESSION['username']; ?>
            </p>
            <div id="verifyUserAcc">Verify Account</div>


            <div class="flexDiv">
                <img src="../img/address.png" alt="" class="addressImg" height="20px">
                <div class="freelanceAddress">
                    <?php echo $_SESSION['address']; ?>
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


    <!-- 

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
    </footer> -->

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
    <script src="../js/user.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>