<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eGawa | Create Profile</title>

    <!-- start -- links for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- end --links for fonts -->


    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/notification.css">
    <link rel="stylesheet" href="../css/createProfile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>


</head>


<body>
    <div class="toast_notif" id="toast_notif"></div>

    <?php print_r($_SESSION);
    print_r($_POST); ?>

    <div class="container">

        <p class="createProfileTitle">Create Profile</p>
        <hr>
        <form id="create_profileForm" method="POST" enctype="multipart/form-data">

            <div class="div1">
                <div class="uploadIMG">

                    <!-- <div id="imgUpl">
                        <p class="labelImage" for="uploadInput">Upload Profile Picture</p>
                        <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                            <img id="uploadedImage" src="../img/uploadIMG.png" alt="Uploaded Image" height="130">
                        </div>
                    </div>


                    <div class="custom-file-input">
                        <label for="file-input" class="custom-file-label">
                            <span><img id="upIMG" src="../img/up2.png" alt=""></span>
                        </label>
                        <input type="file" id="file-input" class="actual-file-input" accept="image/*"
                            onchange="loadImage(event)" required />
                    </div> -->

                    <div class="upload">
                        <img id="uploadedImage" src="../img/uploadIMG.png" width="100" height="100" alt=""
                            class="uploadPic">
                        <div class="round">
                            <input type="file" name="imageProfile" id="file-input" accept="image/*"
                                onchange="loadImage(event)" required>
                            <i class="fa fa-camera" style="color: #fff;"></i>
                        </div>
                    </div>
                </div>


                <hr>

                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Address"
                        required>
                    <label id="addressLabel" for="address">Enter Your Address</label>
                </div>

                <div class="pickRoles">
                    <p id="pickRole" class="title">Please Pick a Job or Role</p>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]"
                            id="webDesign" value="Web Designer">
                        <label class="form-check-label" for="webDesign">Web Designer</label>
                    </div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jobRole[]" id="webDev"
                            value="Web Developer">
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

            </div>


            <div class="div2">
                <p class="userRegTitle title">Work Experience</p>
                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <!-- Gap on all sides is 2 -->
                    <input type="text" id="companyName" name="companyName" class="form-control"
                        placeholder="Enter Company Namess">
                    <label id="companyNameLabel" for="companyName">Enter Company Name</label>
                </div>

                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <!-- Gap on all sides is 2 -->
                    <input type="text" id="workTitle" name="workTitle" class="form-control"
                        placeholder="Enter Worktitle">
                    <label id="workTitleLabel" for="workTitle">Enter Worktitle</label>
                </div>

                <div class="date">
                    <div class="form-floating mb-3 col-6 gx-2 gy-2">
                        <input type="date" id="dateStarted" onchange="updateDateEndedMin()" name="dateStarted" class="form-control"
                            placeholder="Enter Date Started">
                        <label id="dateStartedLabel" for="dateStarted">Enter Date Started</label>
                    </div>

                    <div class="form-floating mb-3 col-6 gx-2 gy-2">
                        <input type="date" id="dateEnded" onchange="updateDateStartedMax()" name="dateEnded" class="form-control"
                            placeholder="Enter Date Ended">
                        <label id="dateEndedLabel" for="dateEnded">Enter Date Ended</label>
                    </div>
                </div>

                <p class="jobDescription" for="comment">Job Description</p>
                <div>
                    <textarea class="form-control" id="comment" name="jobDesc" rows="5"
                        placeholder="Enter job description"></textarea>
                </div>
                <div class="d-grid mt-2 gap-2 d-md-flex justify-content-md-end">

                    <button type="button" id="create_profile" name="btnCreateFreelanceProfile" class="btn btn-primary"
                        onclick="new Account().create_fprofile();">
                        Continue
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="clearInputsProfile()">
                        Clear
                    </button>
                </div>

            </div>
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>



    <script src="../js/freelance.js"></script>
    <script src="../js/script.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>

</body>

</html>