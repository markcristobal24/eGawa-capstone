<?php
session_start();
if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "user") {
    header('location: ../freelance/freelanceHome.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userHomePage.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
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
            <img id="userPic" src="../img/uploads/company/<?php echo $_SESSION['user_image']; ?>" alt="user profile" title="user profile">
            <h2 id="userName">
                <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?>
            </h2>
            <p class="user-name">
                @
                <?php echo $_SESSION['username']; ?>
            </p>
            <!-- <div id="verifyUserAcc">Verify Account</div> -->
            <div id="verifyUserAcc" data-bs-toggle="modal" data-bs-target="#view_dashboard">View Dashboard</div>


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
                        <input id="uploadedImageUser1" type="file" accept="image/*" onchange="loadImageUser(event)" required>
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
    <div class="modal fade" id="staticBackdropYow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <img id="uploadedImageCatalog" src="../img/upload.png" alt="Uploaded Image" height="200">
                            </div>
                            <input id="uploadInput" type="file" name="catalogImg" accept="image/*" onchange="catalogImgUp(event)">
                        </div>

                        <div class="form-floating mb-3 col-11 gx-2 gy-2 mx-auto">
                            <!-- Gap on all sides is 2 -->
                            <input type="text" id="catalogTitle" name="catalogTitle" class="form-control" placeholder="Address">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span>Username's</span> Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-view-more">
                        <div class="modal-pic-container">
                            <img id="userPic" src="../img/uploads/freelancer/<?php echo $fetch['imageProfile']; ?>" alt="user profile" title="user profile">
                        </div>

                        <div class="modal-name-container">
                            <p id="userName">
                                <?php echo $fullname; ?>
                            </p>
                        </div>

                        <p id="freelanceUsername">
                            <?php echo "@" . $fetch['username']; ?>
                        </p>

                        <div class="flexDiv">
                            <img src="../img/address.png" alt="" class="addressImg" height="20px">
                            <div class="freelanceAddress marg">
                                <?php echo $fetch['barangay'] . ', ' . $fetch['municipality'] . ', ' . $fetch['province']; ?>
                            </div>
                        </div>

                        <div class="flexDiv">
                            <img src="../img/email.png" alt="" class="emailImg" height="20px">
                            <div class="freelanceEmail marg">
                                <?php echo $fetch['email']; ?>
                            </div>
                        </div>

                        <div>
                            <div id="" class="titles">
                                Dashboard:
                            </div>
                            <div class="box-">
                                <div class="box-1 boxes">
                                    <span>Posted Jobs:</span>
                                    <span class="boxes-data">100</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Accepted:</span>
                                    <span class="boxes-data">60</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Declined:</span>
                                    <span class="boxes-data">40</span>
                                </div>
                            
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#">Close</button>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>