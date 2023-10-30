<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();
$account = new Account();
$account->fetch_account($_SESSION['email']);
$account->fetch_profile($_SESSION['email']);

if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "freelancer") {
    header('location: ../user/userHome.php');
    die();
}

$email = $_SESSION['email'];
$query = $db->connect()->prepare("SELECT * FROM account INNER JOIN profile ON account.account_id = profile.account_id WHERE account.email = :email");
$query->execute([':email' => $email]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/freelanceHomePage.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery-bundle.css'>


    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa |
        <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>
    </title>
</head>

<body>
    <?php //print_r($_SESSION); 
    ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>
    <div class="containerUserHome">

        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <span class=catalogNavtitle>Previous Jobs</span>
                <div class="left-nav">
                    <button class=addCatalog data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add
                        Catalog</button>
                </div>
            </div>

            <div class="containerLeft-Feed" id="post_container">
                <?php
                $query = $db->connect()->prepare("SELECT * FROM catalog WHERE email = :email ORDER BY date_created DESC");
                $query->execute([':email' => $email]);
                if ($query->rowCount() > 0) {
                    foreach ($query as $row) {
                        $catalog_id = $row['catalog_id'];
                ?>
                        <div class="containerPost">
                            <div class="containerImg">
                                <img src="../img/uploads/freelancer/catalog/<?php echo $row['catalogImage']; ?>" alt="" id="containerImg">
                            </div>
                            <div class="containerCatalog">
                                <span class="titlePost">
                                    <?php echo $row['catalogTitle']; ?>
                                </span>
                                <p class="descPost">
                                    <?php echo $row['catalogDescription']; ?>
                                </p>
                                <div>
                                    <button type="button" id="viewPostBTN" class="" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="new Catalog().view_catalogs(<?php echo $catalog_id; ?>);">View Catalog</button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="containerPost">';

                    echo '<div class="catalogImg">';
                    echo '<img class="imgWork" src="../img/box.png">';
                    echo '</div>';

                    echo '<div class="catalogTexts">';
                    echo '<h3>No previous job to display</h3>';
                    echo '<p>There is no catalog available at the moment. <br> Please add one</p>';
                    echo '</div>';

                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="containerRight">
            <div class="userProfile">
                <div class="userProfileChild" id="userProfileChild">
                    <a class="userPic" href="../img/uploads/freelancer/<?php echo $fetch['imageProfile']; ?>">
                        <img id="userPic" src="../img/uploads/freelancer/<?php echo $fetch['imageProfile']; ?>" alt="user profile" title="user profile">
                    </a>


                    <p id="userName">
                        <?php echo $fullname; ?>
                    </p>

                    <p id="freelanceUsername">
                        <?php echo "@" . $fetch['username']; ?>
                    </p>

                    <a href="view_freelance_rating.php" id="rating">
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i id="average_rating">4.5/5</i><span> / 5</span>
                        <span>(<i id="total_review">4.5 </i> Reviews)</span>
                    </a>

                    <div class="rating">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>

                    <div id="jobsAndRole1">Jobs and Roles:</div>
                    <ul>
                        <?php
                        $query = $db->connect()->prepare("SELECT * FROM profile WHERE email = :email");
                        $query->execute([':email' => $email]);
                        // $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                        if ($query->rowCount() > 0) {
                            $roleValues = array();

                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
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
                    <?php
                    $check_verify = $db->connect()->prepare("SELECT * FROM id_verification WHERE account_id = :account_id AND verify_status = :status");
                    $check_verify->execute([':account_id' => $_SESSION['account_id'], ':status' => 'PENDING']);

                    if ($check_verify->rowCount() > 0) {
                    ?>
                        <button disabled class="mt-3">ONGOING
                            VERIFICATION</button>
                    <?php
                    } else {
                    ?>
                        <button class="mt-3"><a id="verifyFreelanceAcc" href="../id_verification.php?freelance_id=<?php echo $_SESSION['account_id'] ?>">Verify
                                Account</a></button>
                    <?php
                    }
                    ?>

                    <!-- <button class="mt-3"><a id="subs-button-profile" href="">Subscribe</a></button> -->
                    <button class="mt-3" data-bs-toggle="modal" data-bs-target="#view_profile">View More</button>

                </div>
            </div>
        </div>


    </div>


    <!-- Modal for view catalog-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-view-catalog">
                    <div class="containerImg">
                        <img id="catalogImage" src="../img/work2.png" alt="">
                    </div>
                    <hr>
                    <h1 class="modal-title fs-5 titles" id="">Description</h1>
                    <div class="container-description" id="container-description">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#edit-catalog-modal">Edit</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for adding catalog-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Catalog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-add">

                    <form id="catalog_form" method="POST" enctype="multipart/form-data">
                        <div class="input">
                            <img id="uploadedImageCatalog" class="img-modal" src="../img/uploadIMG.png" alt="Uploaded Image" height="200">
                            <input id="uploadInput" type="file" name="catalogImg" accept="image/*" onchange="catalogImgUp(event)" required>
                        </div>

                        <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                            <input type="text" id="catalogTitle" name="catalogTitle" class="form-control" placeholder="Enter Catalog Title" required>
                            <label id="catalogTitleLabel" for="companyName">Enter Catalog Title</label>
                        </div>

                        <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                            <textarea class="form-control" id="catalogDescription" name="catalogDesc" rows="10" placeholder="Enter Catalog Description" required></textarea>
                            <label id="catalogDescriptionLabel" for="catalogDescription">Enter Catalog
                                Description</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearInputs()">Close</button>
                            <button type="button" class="btn btn-primary" id="add_catalog" onclick="new Catalog().add_catalog();">Submit</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal for editing catalog-->
    <div class="modal fade" id="edit-catalog-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Catalog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-add">
                    <form id="edit_catalogForm" method="POST" enctype="multipart/form-data">
                        <div class="input">
                            <img id="uploadedEditImageCatalog" class="img-modal" src="../img/uploadIMG.png" alt="Uploaded Image" height="200">
                            <input id="editInput" type="file" name="catalogImg" accept="image/*" onchange="catalogEditImgUp(event)" required>
                        </div>

                        <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                            <input type="text" id="edit-catalot-title" name="catalogTitleEdit" class="form-control" placeholder="Enter Catalog Title" required>
                            <label id="catalogTitleLabel" for="edit-catalot-title">Enter Catalog Title</label>
                        </div>

                        <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                            <textarea class="form-control" id="edit-catalog-desc" name="catalogEditDescription" rows="10" placeholder="Enter Catalog Description" required></textarea>
                            <label id="catalogDescriptionLabel" for="edit-catalog-desc">Enter Catalog
                                Description</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearEditModal()">Close</button>
                            <button type="button" id="edit_catalog" onclick="new Catalog().edit_catalog(this.value);" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal confirmation for deleting catalog-->
    <div class="modal fade" id="confirm-delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Catalog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this catalog?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_catalog" onclick="new Catalog().delete_catalog(this.value);">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for view profile-->
    <div class="modal fade" id="view_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your Profile</h1>
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



                        <div id="" class="titles">
                            Jobs and Roles:
                        </div>

                        <ul>
                            <?php
                            $query = $db->connect()->prepare("SELECT * FROM profile WHERE email = :email");
                            $query->execute([':email' => $email]);
                            // $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                            if ($query->rowCount() > 0) {
                                $roleValues = array();

                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    $values = explode(',', $row['jobRole']);
                                    $roleValues = array_merge($roleValues, $values);
                                }

                                foreach ($roleValues as $value) {
                                    echo "<li>$value</li>";
                                }
                            }
                            ?>
                        </ul>
                        <div>
                            <div class="titles">
                                <!-- Work Experience -->
                            </div>
                            <div>
                                <div>
                                    <!-- <span>Company Name: </span> <span> -->
                                    <?php
                                    //  echo $fetch['companyName']; 
                                    ?>
                                    </span>
                                </div>
                                <div>
                                    <!-- <span>Date Started: </span> <span> -->
                                    <?php
                                    // $date = $fetch['startDate'];
                                    // $dateObj = new DateTime($date);
                                    // $startDate = $dateObj->format("F d, Y");
                                    // echo $startDate;
                                    ?>
                                    </span>
                                </div>
                                <div>
                                    <!-- <span>Date Ended: </span> <span> -->
                                    <?php
                                    // $date = $fetch['endDate'];
                                    // $dateObj = new DateTime($date);
                                    // $endDate = $dateObj->format("F d, Y");
                                    // echo $endDate; 
                                    ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="titles">
                                <!-- Job Description -->
                            </div>
                            <div>
                                <span>
                                    <?php
                                    //  echo $fetch['jobDescription'];
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div id="" class="titles">
                                Dashboard:
                            </div>
                            <div class="box-">
                                <div class="box-1 boxes">
                                    <span>Applied:</span>
                                    <span class="boxes-data" id="total_applied_freelancer">100</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Accepted:</span>
                                    <span class="boxes-data" id="total_accepted_freelancer">60</span>
                                </div>
                                <div class="box-2 boxes">
                                    <span>Declined:</span>
                                    <span class="boxes-data" id="total_declined_freelancer">60</span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#hey">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for edit profile-->
    <div class="modal fade" id="hey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit_profile" method="POST" enctype="multipart/form-data">
                        <div id="imgUpl">
                            <label class="labelImage" for="uploadInput">Upload New Profile Picture</label>
                            <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                                <img id="uploadedEditImage" src="../img/uploadIMG.png" alt="Uploaded Image" height="200">
                            </div>
                            <input id="uploadInputEdit" class="mx-4 my-3" type="file" name="imageProfile" accept="image/*" onchange="editImgUp(event)">
                        </div>

                        <!-- <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                            <input type="text" id="new_barangay" name="new_barangay" class="form-control" placeholder="Edit your address" value="<?php echo $_SESSION['barangay']; ?>">
                            <label id="editAddressLabel" for="editAddress">Edit Street/Baranggay</label>
                        </div>
                        <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                            <input type="text" id="new_municipality" name="new_municipality" class="form-control" placeholder="Edit your address" value="<?php echo $_SESSION['municipality']; ?>">
                            <label id="editAddressLabel" for="editAddress">Edit Municipality</label>
                        </div>
                        <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                            <input type="text" id="new_province" name="new_province" class="form-control" placeholder="Edit your address" value="<?php echo $_SESSION['province']; ?>">
                            <label id="editAddressLabel" for="editAddress">Edit City/Province</label>
                        </div> -->

                        <div class="addr">
                            <label class="font" for="addr">City/Province</label>
                            <!-- <input id="new_province" type="text" value="" name="new_province" class="text"> -->
                            <select class="add-" name="province" id="provinceDropdown" onchange="updateMunicipalityDropdown()">
                                <option value="">Select Province</option>
                            </select>
                        </div>

                        <div class="addr">
                            <label class="font" for="addr">Municipality</label>
                            <!-- <input id="new_municipality" type="text" value="" name="new_municipality" class="text"> -->
                            <select class="add-" name="municipality" id="municipalityDropdown" onchange="updateBarangayDropdown()">
                            </select>
                        </div>

                        <div class="addr mb-5">
                            <label class="font" for="addr">Street/Barangay</label>
                            <!-- <input id="new_barangay" type="text" value="" name="new_barangay" class="text"> -->
                            <select class="add-" name="barangay" id="barangayDropdown">
                            </select>
                        </div>


                        <input type="hidden" name="selectedProvince" id="selectedProvince">
                        <input type="hidden" name="selectedMunicipality" id="selectedMunicipality">
                        <input type="hidden" name="selectedBarangay" id="selectedBarangay">


                        <div class="mb-3 col-10 gx-2 gy-2 mx-auto EditRoles">
                            <h4 id="pickRole" class="title">Please Pick a Job or Role</h4>
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="webDesign" value="Web Designer">
                                <label class="form-check-label" for="webDesign">Web Designer</label>
                            </div>

                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="webDev" value="Web Developer">
                                <label class="form-check-label" for="webDev">Web Developer</label>
                            </div>

                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="mobAppDev" value="Mobile Application Developer">
                                <label class="form-check-label" for="mobAppDev">Mobile Application Developer</label>
                            </div>

                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="brandDesign" value="Brand and Designing">
                                <label class="form-check-label" for="brandDesign">Branding and Design</label>
                            </div>

                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="hostingMaintenance" value="Hosting/Maintenance">
                                <label class="form-check-label" for="hostingMaintenance">Hosting/Maintenance</label>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="btnEditFreelanceProfile" id="edit_fprofile" onclick="new Account().edit_fprofile();">
                                Save
                            </button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary" id="cancelEdit">
                                Cancel
                            </button>
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

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    </div>

    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.min.js'>
    </script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/video/lg-video.umd.js'></script>


    <script src="../js/createNewDiv.js"></script>
    <script src="../classJS/Catalog.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Dashboard.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../js/script.js"></script>
    <!-- <script src="../js/validate.js"></script> -->
    <script src="../js/freelance.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        new Dashboard().get_information_freelancer();
        new Account().fetch_ratings_freelancer(<?php echo $_SESSION['account_id'] ?>);
        // let counter = 0;
        // if (counter <= 0) {
        //     lightGallery(document.getElementById('userProfileChild'), {
        //         counter: false,
        //         download: true,
        //         backdropDuration: 100,
        //         selector: 'a',
        //         controls: false,
        //         escKey: true
        //     });
        //     counter++;
        // }
        async function fetchDataFromJSON(file) {
            const response = await fetch(file);
            const data = await response.json();
            return data;
        }

        async function populateProvinceDropdown() {
            const provincesData = await fetchDataFromJSON('../json/address/province.json');
            const provinces = provincesData;

            const provinceDropdown = document.getElementById('provinceDropdown');
            provinceDropdown.innerHTML = '';

            for (const province of provinces) {
                const option = document.createElement('option');
                option.value = province.province_code;
                option.textContent = province.province_name;
                option.setAttribute('data-name', province.province_name);
                provinceDropdown.appendChild(option);
            }

            document.getElementById('selectedProvince').value = provinceDropdown.value;
        }

        async function updateMunicipalityDropdown() {
            const selectedProvince = document.getElementById('provinceDropdown').value;
            const municipalitiesData = await fetchDataFromJSON('../json/address/city.json');
            const municipalities = municipalitiesData.filter(municipality => municipality.province_code ===
                selectedProvince);

            const municipalityDropdown = document.getElementById('municipalityDropdown');
            municipalityDropdown.innerHTML = '';

            for (const municipality of municipalities) {
                const option = document.createElement('option');
                option.value = municipality.city_code;
                option.textContent = municipality.city_name;
                option.setAttribute('data-name', municipality.city_name);
                municipalityDropdown.appendChild(option);
            }
            document.getElementById('selectedCity').value = municipalityDropdown.value;
            // Update barangay dropdown as well
            updateBarangayDropdown();
        }

        async function updateBarangayDropdown() {
            const selectedMunicipality = document.getElementById('municipalityDropdown').value;
            const barangaysData = await fetchDataFromJSON('../json/address/barangay.json');
            const barangays = barangaysData.filter(barangay => barangay.city_code === selectedMunicipality);

            const barangayDropdown = document.getElementById('barangayDropdown');
            barangayDropdown.innerHTML = '';

            for (const barangay of barangays) {
                const option = document.createElement('option');
                option.value = barangay.brgy_code;
                option.textContent = barangay.brgy_name;
                option.setAttribute('data-name', barangay.brgy_name);
                barangayDropdown.appendChild(option);
            }
        }
        document.getElementById('selectedBarangay').value = barangayDropdown.textContent;
        populateProvinceDropdown();

        document.getElementById('provinceDropdown').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const selectedProvince = selectedOption.getAttribute('data-name');
            document.getElementById('selectedProvince').value = selectedProvince;
        });

        // Update municipality dropdown
        document.getElementById('municipalityDropdown').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const selectedMunicipality = selectedOption.getAttribute('data-name');
            document.getElementById('selectedMunicipality').value = selectedMunicipality;
        });

        // Update barangay dropdown
        document.getElementById('barangayDropdown').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const selectedBarangay = selectedOption.getAttribute('data-name');
            document.getElementById('selectedBarangay').value = selectedBarangay;
        });
    </script>
</body>

</html>