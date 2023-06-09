<?php
session_start();
require dirname(__FILE__) . "/php/classes/DbConnection.php";

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    die();
}

$email = $_SESSION['email'];
$sql = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
$check_rows = mysqli_num_rows($sql);
$fetch = mysqli_fetch_assoc($sql);

$sql2 = mysqli_query($con, "SELECT * FROM account WHERE email ='$email'");
$check_rows2 = mysqli_num_rows($sql2);
$fetch2 = mysqli_fetch_assoc($sql2);
$fullname = $fetch2['firstName'] . ' ' . $fetch2['middleName'] . ' ' . $fetch2['lastName'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="css/freelanceHomePage.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Freelance Homepage</title>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/eGAWAwhite.png" alt="Logo" id="logoImage"></a>
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
                        <a id="freeLanceInbox" class="nav-link" href="freeLanceInbox.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a id="logout1" class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="containerFreelanceHome">

        <div class="div2">
            <div class="containerCatalog">
                <div id="container">
                    <!-- <div class="item" id="item-1" onclick="handleClick(this)">
                        <div class="catalogImg">
                            <img class="imgWork" src="img/working.png"  alt="Image 1">
                        </div>
                        <div class="catalogTexts">
                            <h3>Title 1</h3>
                            <p>Description 1</p>
                        </div>                        
                    </div> -->
                    <?php
                    $displayCatalog = mysqli_query($con, "SELECT * FROM catalog WHERE email = '$email'");
                    if ($displayCatalog->num_rows > 0) {
                        while ($row = $displayCatalog->fetch_assoc()) {
                            $catalogId = $row['catalog_id'];
                            ?>
                            <div class="item">
                                <div class="catalogImg">
                                    <img class="imgWork"
                                        src="https://res.cloudinary.com/dm6aymlzm/image/upload/<?php echo $row['catalogImage']; ?>">
                                </div>
                                <div class="catalogTexts">
                                    <h3>
                                        <?php echo $row['catalogTitle']; ?>
                                    </h3>
                                    <p>
                                        <?php echo $row['catalogDescription'] ?>
                                    </p>
                                </div>

                                <div id="collapseExample">
                                    <div id="catalogItemButton">
                                        <button type="button" onclick="new Catalog().delete_catalog(<?php echo $catalogId; ?>)"
                                            id="deleteCatalogBtn" class="btn btn-primary" name="btnDeleteCatalog">
                                            Delete
                                        </button>
                                        <button type="button" id="editCatalogBtn" class="btn btn-primary">
                                            Edit
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="catalogButtons">
                <button id="addCatalog" class="">Add Catalog</button>
            </div>
        </div>

        <div class="div1">

            <img id="freelancerPic"
                src="https://res.cloudinary.com/dm6aymlzm/image/upload/<?php echo $fetch['imageProfile']; ?>"
                alt="user profile" title="user profile">
            <h2 id="freelanceName">
                <?php echo $fullname; ?>
            </h2>
            <div id="verifyFreelanceAccDiv"><a id="verifyFreelanceAcc" href="freelanceIDVerification.php">Verify
                    Account</a></div>
            <div id="jobsAndRole1">Jobs and Roles:</div>
            <ul>
                <!-- <li class="job one">Sample Job1</li>
                <li class="job two"></li>
                <li class="job three"></li>
                <li class="job four"></li>
                <li class="job five"></li> -->
                <?php
                $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                if ($query->num_rows > 0) {
                    $roleValues = array();

                    while ($row = $query->fetch_assoc()) {
                        $values = explode(',', $row['jobRole']);
                        $roleValues = array_merge($roleValues, $values);
                    }

                    foreach ($roleValues as $value) {
                        echo "<li>$value</li>";
                    }
                }
                ?>
            </ul>

            <div class="flexDiv">
                <img src="img/address.png" alt="" class="addressImg" height="20px">
                <div class="freelanceAddress">
                    <?php echo $fetch['address']; ?>
                </div>
            </div>
            <div class="flexDiv">
                <img src="img/email.png" alt="" class="emailImg" height="20px">
                <div class="freelanceEmail">
                    <?php echo $email; ?>
                </div>
            </div>
            <div id="viewmore">View More</div>
            <div>

            </div>
            <!-- <div class="editContainer">
                <div id="editFreelanceAcc">Edit Account</div>
            </div> -->
        </div>
    </div>


    <!-- this modal is for freelance profile if you click "view more" -->
    <div class="modal fade" id="modalViewMore" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="titles" id="modalTitleViewMore">User Profile</div>
                </div>

                <img id="freelancerPic"
                    src="https://res.cloudinary.com/dm6aymlzm/image/upload/<?php echo $fetch['imageProfile']; ?>"
                    alt="user profile" title="user profile">
                <h2 id="freelanceName">
                    <?php echo $fullname; ?>
                </h2>

                <div class="flexDiv">
                    <img src="img/address.png" alt="" class="addressImg" height="20px">
                    <div class="freelanceAddress">
                        <?php echo $fetch['address']; ?>
                    </div>
                </div>
                <div class="flexDiv">
                    <img src="img/email.png" alt="" class="emailImg" height="20px">
                    <div class="freelanceEmail">
                        <?php echo $email; ?>
                    </div>
                </div>

                <div class="titles">Jobs and Roles:</div>
                <ul>

                    <?php
                    $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                    if ($query->num_rows > 0) {
                        $roleValues = array();

                        while ($row = $query->fetch_assoc()) {
                            $values = explode(',', $row['jobRole']);
                            $roleValues = array_merge($roleValues, $values);
                        }

                        foreach ($roleValues as $value) {
                            echo "<li>$value</li>";
                        }
                    }
                    ?>
                </ul>

                <hr>
                <div class="titles">Work Experience</div>
                <div class="flexDiv" id="workExpi1">
                    <div class="companyNameModal1">Company Name:&nbsp;</div>
                    <div class="companyNameModal1Data">
                        <?php echo $fetch['companyName']; ?>
                    </div>
                </div>
                <div class="flexDiv">
                    <div class="dateStartedModal1">Date Started:&nbsp;</div>
                    <div class="dateStartedModal1Data">
                        <?php echo $fetch['startDate']; ?>
                    </div>
                </div>
                <div class="flexDiv">
                    <div class="dateEndedModal1">Date Ended:&nbsp;</div>
                    <div class="dateEndedModal1Data">
                        <?php echo $fetch['endDate']; ?>
                    </div>
                </div>


                <div class="flexDiv" id="workExpi2">
                    <div class="companyNameModal2"></div>
                    <div class="companyNameModal2Data"></div>
                </div>
                <div class="flexDiv">
                    <div class="dateStartedModal2"></div>
                    <div class="dateStartedModal2Data"></div>
                </div>
                <div class="flexDiv">
                    <div class="dateEndedModal2"></div>
                    <div class="dateEndedModal2Data"></div>
                </div>

                <hr>
                <div class="titles">Job Description</div>
                <p id="jobDescModal">
                    <?php echo $fetch['jobDescription']; ?>
                </p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="editFreelanceAcc">
                        Edit
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelViewMore">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- this modal is for freelance EDIT profile-->
    <div class="modal fade" id="modalEditAccount" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Profile</h3>
                </div>

                <form action="" required>
                    <div id="imgUpl">
                        <label class="labelImage" for="uploadInput">Upload New Profile Picture</label>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedEditImage" src="img/upload.png" alt="Uploaded Image" height="200">
                        </div>
                        <input id="uploadInputEdit" type="file" name="imageProfile" accept="image/*"
                            onchange="editImgUp(event)" required>
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <input type="text" id="editAddress" name="editAddress" class="form-control"
                            placeholder="Edit your address" required>
                        <label id="editAddressLabel" for="editAddress">Edit your address</label>
                    </div>
                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <input type="text" id="editEmailAddress" name="editEmailAddress" class="form-control"
                            placeholder="Edit your email address" required>
                        <label id="editEmailAddressLabel" for="editEmailAddress">Edit your email address</label>
                    </div>


                    <div class="mb-3 col-10 gx-2 gy-2 mx-auto EditRoles">
                        <h4 id="pickRole" class="title">Please Pick a Job or Role</h4>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                                id="webDesign" value="Web Designer">
                            <label class="form-check-label" for="webDesign">Web Designer</label>
                        </div>

                        <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                                id="webDev" value="Web Developer">
                            <label class="form-check-label" for="webDev">Web Developer</label>
                        </div>

                        <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                                id="mobAppDev" value="Mobile Application Developer">
                            <label class="form-check-label" for="mobAppDev">Mobile Application Developer</label>
                        </div>

                        <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                                id="brandDesign" value="Brand and Designing">
                            <label class="form-check-label" for="brandDesign">Branding and Design</label>
                        </div>

                        <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                                id="hostingMaintenance" value="Hosting/Maintenance">
                            <label class="form-check-label" for="hostingMaintenance">Hosting/Maintenance</label>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submitEdit">
                            Save
                        </button>
                        <button class="btn btn-secondary" id="cancelEdit">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>







    <!--Modal for Freelancer account adding catalog-->
    <div class="modal fade" id="modalFreelanceAddCatalog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add Catalog</h3>
                </div>

                <form action="controller/c_catalog.php" method="POST" enctype="multipart/form-data" required>
                    <div id="imgUpl">
                        <label class="labelImage" for="uploadInput">Upload Catalog Picture</label>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedImageCatalog" src="img/upload.png" alt="Uploaded Image" height="200">
                        </div>
                        <input id="uploadInput" type="file" name="catalogImg" accept="image/*"
                            onchange="catalogImgUp(event)" required>
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <input type="text" id="catalogTitle" name="catalogTitle" class="form-control"
                            placeholder="Enter Catalog Title" required>
                        <label id="catalogTitleLabel" for="companyName">Enter Catalog Title</label>
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <textarea class="form-control" id="catalogDescription" name="catalogDesc" rows="10"
                            placeholder="Enter Catalog Description" required></textarea>

                        <label id="catalogDescriptionLabel" for="catalogDescription">Enter Catalog Description</label>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" name="btnAddCatalog" class="btn btn-primary" id="submitUserID">
                            Submit
                        </button>
                        <button class="btn btn-secondary" id="cancelSubmit">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Proceed to Delete?</h5>
                </div>
                <div class="modal-body">
                    <div id="deleteModalMessage" class="p-4"> Are you sure you want to delete the selected game?</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="deleteNo" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="deleteYes">Yes</button>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/createNewDiv.js"></script>
    <script src="js/Catalog.js"></script>
    <script src="js/script.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/freelance.js"></script>
</body>

</html>