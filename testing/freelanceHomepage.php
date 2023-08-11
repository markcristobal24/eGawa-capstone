
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelanceHomePage.css">
    <link rel="stylesheet" href="../css/notification.css">


    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>



    <title>eGawa | Freelance Homepage</title>

</head>

<body>
    <?php //print_r($_SESSION); ?>
    <div class="toast_notif" id="toast_notif"></div>
    <?php include "../other/navbar.php"; ?>

    <div class="mainContainer">

        <div class="left">

        </div>
        <div class="right">

            <div class="imgContainer">
                <img class="imgProfile" src="../img/profile.png" alt="">
            </div>
            <div class="freelanceInfoCOntainter">
                
            </div>

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
                    src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $fetch['imageProfile']; ?>"
                    alt="user profile" title="user profile">
                <h2 id="freelanceName">
                    <?php echo $fullname; ?>
                </h2>
                <div class="freelanceUsernameContainer">
                    <h4 id="freelanceUsername">
                        <?php echo "@" . $_SESSION['username']; ?>
                    </h4>
                </div>
                <div class="rating">
                    <span class="star" data-value="1"></span>
                    <span class="star" data-value="2"></span>
                    <span class="star" data-value="3"></span>
                    <span class="star" data-value="4"></span>
                    <span class="star" data-value="5"></span>
                </div>

                <div class="flexDiv">
                    <img src="../img/address.png" alt="" class="addressImg" height="20px">
                    <div class="freelanceAddress">
                        <?php echo $fetch['address']; ?>
                    </div>
                </div>
                <div class="flexDiv">
                    <img src="../img/email.png" alt="" class="emailImg" height="20px">
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
                    <h3 class="modalTitles">Edit Profile</h3>
                </div>

                <form id="edit_profile" method="POST" enctype="multipart/form-data">
                    <div id="imgUpl">
                        <label class="labelImage" for="uploadInput">Upload New Profile Picture</label>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedEditImage" src="../img/upload.png" alt="Uploaded Image" height="200">
                        </div>
                        <input id="uploadInputEdit" type="file" name="imageProfile" accept="image/*"
                            onchange="editImgUp(event)">
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <input type="text" id="editAddress" name="editAddress" class="form-control"
                            placeholder="Edit your address" value="<?php echo $_SESSION['address']; ?>">
                        <label id="editAddressLabel" for="editAddress">Edit your address</label>
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
                        <button type="button" class="btn btn-primary" name="btnEditFreelanceProfile" id="edit_fprofile"
                            onclick="new Account().edit_fprofile();">
                            Save
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelEdit">
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
                    <h3 class="modalTitles">Add Catalog</h3>
                </div>

                <form id="catalog_form" method="POST" enctype="multipart/form-data" required>
                    <div id="imgUpl">
                        <label class="labelImage" for="uploadInput">Upload Catalog Picture</label>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedImageCatalog" src="../img/upload.png" alt="Uploaded Image" height="200">
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
                        <button type="button" name="btnAddCatalog" class="btn btn-primary" id="add_catalog"
                            onclick="new Catalog().add_catalog();">
                            Submit
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelSubmit" onclick="cancelAddCatalog()">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!--Modal for Freelancer EDITING CATALOG-->
    <div class="modal fade" id="modalFreelanceEditCatalog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modalTitles">Edit Catalog</h3>
                </div>

                <form id="edit_catalog" method="POST" enctype="multipart/form-data">
                    <div id="imgUpl">

                        <label class="labelImage" for="uploadInput">Edit Catalog Picture</label>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedEditImageCatalog" src="../img/upload.png" alt="Uploaded Image"
                                height="200">
                        </div>
                        <input id="uploadInput" type="file" name="catalogImg" accept="image/*"
                            onchange="catalogEditImgUp(event)" required>
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <input type="text" id="catalogTitleEdit" name="catalogTitleEdit" class="form-control"
                            placeholder="Enter New Catalog Title" required>
                        <label id="newCatalogTitleLabel" for="catalogTitleEdit">Enter New Catalog Title</label>
                    </div>

                    <div class="form-floating mb-3 col-10 gx-2 gy-2 mx-auto">
                        <!-- Gap on all sides is 2 -->
                        <textarea class="form-control" id="catalogEditDescription" name="catalogEditDescription"
                            rows="10" placeholder="Enter New Catalog Description" required></textarea>

                        <label id="catalogDescriptionLabel" for="catalogEditDescription">Enter New Catalog
                            Description</label>
                    </div>


                    <div class="modal-footer">
                        <?php
                        $catalogId = $_SESSION['catalogId'];
                        ?>
                        <button type="button" onclick="new Catalog().edit_catalog(<?php echo $catalogId; ?>)"
                            name="btnEditCatalog" class="btn btn-primary" id="submitEditCatalog">
                            Submit
                        </button>
                        <button class="btn btn-secondary" id="cancelEditCatalog">
                            Cancel
                        </button>
                    </div>
                </form>
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
    <script src="../js/createNewDiv.js"></script>
    <script src="../classJS/Catalog.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/validate.js"></script>
    <script src="../js/freelance.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var flag = localStorage.getItem('showModalFlag');

            if (flag === 'true') {
                var isReloaded = performance.navigation.type === 1;

                if (isReloaded) {
                    edit_catalog();
                    localStorage.removeItem('showModalFlag');
                }
            }
        });
    </script>
</body>


</html>