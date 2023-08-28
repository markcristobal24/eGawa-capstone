<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

$user_id = $_SESSION['account_id'];
$sql = mysqli_query($con, "SELECT * FROM account WHERE account_id = '$user_id'");
$fetch = $sql->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelanceHomepage.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?></title>

    <style>

    </style>

</head>

<body>
    <?php //print_r($_SESSION); ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>
    <div class="containerUserHome">

        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <span class=catalogNavtitle>Catalogs</span>
                <div class="left-nav">
                    <button class=addCatalog data-bs-toggle="modal"  data-bs-target="#staticBackdrop">Add Catalog</button>
                </div> 
            </div>

            <div class="containerLeft-Feed" id="post_container">

                <div class="containerPost">
                    <div class="containerImg">
                        <img id="containerImg" src="../img/work2.png" alt="">
                    </div>
                    <div class="containerCatalog">
                        <span class="titlePost">Sample Title</span>
                        <!-- <div>
                            <span class="author">Author: </span>
                            <span class="userPost">Arebeen</span>
                        </div>

                        <div>
                            <span class="locationPost">Hagonoy, Bulacan</span>
                            <span>•</span>
                            <span class="datePost">January 01, 1969</span>
                        </div> -->

                        <p class="descPost">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                                when an unknown printer took a galley of type and scrambled it to make a type 
                                specimen book. It has survived not only five centuries, 
                                but also the leap into electronic typesetting, remaining essentially unchanged. 
                                It was popularised in the 1960s with the release of Letraset sheets containing 
                                Lorem Ipsum passages, and more recently with desktop publishing software like 
                                Aldus PageMaker including versions of Lorem Ipsum.
                        </p>
                        <div>
                            <button type="button" id="viewPostBTN" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">View Catalog</button>
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                View Catalog</button> -->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="containerRight">
            <div class="userProfile">
                <div class="userProfileChild">
                    <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">

                    <p id="userName">
                        <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>
                    </p>

                    <p id="freelanceUsername">
                        @sampleusername
                    </p>

                    <div class="rating">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>

                    <div id="jobsAndRole1">Jobs and Roles:</div>
                        <ul>
                            <li>job1</li>
                            <li>job2</li>
                            <li>job3</li>
                        </ul>

                    <div class="flexDiv">
                        <img src="../img/address.png" alt="" class="addressImg" height="20px">
                        <div class="freelanceAddress marg">
                            sample address
                        </div>
                    </div>

                    <div class="flexDiv">
                        <img src="../img/email.png" alt="" class="emailImg" height="20px">
                        <div class="freelanceEmail marg">
                            sampleemail@gmail.com
                        </div>    
                    </div>

                    <button class="mt-3"><a id="verifyFreelanceAcc" href="freelanceIDVerification.php">Verify Account</a></button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Catalog title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body-view-catalog">
                <div class="containerImg">
                    <img id="containerImg" src="../img/work2.png" alt="">
                </div>
                <div class="container-description">
                ...
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#edit-catalog-modal">Edit</button>
                <button type="button" class="btn btn-primary">Delete</button>
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
                <div class="input">
                    <img id="uploadedImageCatalog" class="img-modal" src="../img/uploadIMG.png" alt="Uploaded Image" height="200">
                    <input id="uploadInput" type="file" name="catalogImg" accept="image/*"
                            onchange="catalogImgUp(event)" required>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                    <input type="text" id="catalogTitle" name="catalogTitle" class="form-control"
                            placeholder="Enter Catalog Title" required>
                    <label id="catalogTitleLabel" for="companyName">Enter Catalog Title</label>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                    <textarea class="form-control" id="catalogDescription" name="catalogDesc" rows="10"
                            placeholder="Enter Catalog Description" required></textarea>
                    <label id="catalogDescriptionLabel" for="catalogDescription">Enter Catalog Description</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearInputs()">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
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
                <div class="input">
                    <img id="uploadedEditImageCatalog" class="img-modal" src="../img/uploadIMG.png" alt="Uploaded Image" height="200">
                    <input id="editInput" type="file" name="catalogImg" accept="image/*"
                            onchange="catalogEditImgUp(event)" required>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                    <input type="text" id="edit-catalot-title" name="catalogTitle" class="form-control"
                            placeholder="Enter Catalog Title" required>
                    <label id="catalogTitleLabel" for="companyName">Enter Catalog Title</label>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2 mx-auto">
                    <textarea class="form-control" id="edit-catalog-desc" name="catalogDesc" rows="10"
                            placeholder="Enter Catalog Description" required></textarea>
                    <label id="catalogDescriptionLabel" for="catalogDescription">Enter Catalog Description</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearEditModal()">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal for view profile-->
    <div class="modal fade" id="view_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Your Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body-view-more">
                    <div class="modal-pic-container">
                        <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">
                    </div>
                    
                    <div class="modal-name-container">
                        <p id="userName">
                            <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>
                        </p>
                    </div>

                    <p id="freelanceUsername">
                        @sampleusername
                    </p>

                    <div class="flexDiv">
                        <img src="../img/address.png" alt="" class="addressImg" height="20px">
                        <div class="freelanceAddress marg">
                            sample address
                        </div>
                    </div>

                    <div class="flexDiv">
                        <img src="../img/email.png" alt="" class="emailImg" height="20px">
                        <div class="freelanceEmail marg">
                            sampleemail@gmail.com
                        </div>
                    </div>

                    <div class="rating">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>

                    <div id="" class="titles">
                        Jobs and Roles:
                    </div>
                        
                    <ul>
                        <li>job1</li>
                        <li>job2</li>
                        <li>job3</li>
                    </ul>
                    <div>
                        <div class="titles">
                            Work Experience
                        </div>
                        <div>
                            <div>
                                <span>company name: </span> <span>PLDC</span>
                            </div>
                            <div>
                                <span>date started: </span> <span>Feb 14, 1969</span>
                            </div>
                            <div>
                                <span>date ended: </span> <span>Feb 14, 1970</span>
                            </div>
                        </div>
                    </div> 
                    <div>
                        <div class="titles">
                            Job Description
                        </div>
                        <div>
                            <span>
                                This is a sample job description
                            </span>
                        </div>
                    </div>                  
                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-primary">Verify</button>
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




    <script src="../js/createNewDiv.js"></script>
    <script src="../classJS/Catalog.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/validate.js"></script>
    <script src="../js/freelance.js"></script>
    <script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>