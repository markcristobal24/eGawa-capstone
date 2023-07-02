<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="css/F_createProfile.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Freelance Profile Creation</title>

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

    <div class="containerFreelanceCreate">
        <form action="controller/c_createProfile.php" method="POST" enctype="multipart/form-data">
            <div class="div1">
                <div id="imgUpl">
                    <label class="labelImage" for="uploadInput">Upload Profile Picture</label>
                    <div class="image-holder d-grid gap-2 d-md-flex justify-content-md-center">
                        <img id="uploadedImage" src="img/upload.png" alt="Uploaded Image" height="200">
                    </div>
                    <input id="uploadInput" type="file" accept="image/*" onchange="loadImage(event)" required>
                </div>
                <hr>

                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Address"
                        required>
                    <label id="addressLabel" for="address">Enter Your Address</label>
                </div>

                <div class="pickRoles">
                    <h4 id="pickRole" class="title">Please Pick a Job or Role</h4>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="webDesign">
                        <label class="form-check-label" for="webDesign">Web Designer</label>
                    </div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" id="webDev">
                        <label class="form-check-label" for="webDev">Web Developer</label>
                    </div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" id="mobAppDev">
                        <label class="form-check-label" for="mobAppDev">Mobile Application Developer</label>
                    </div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" id="brandDesign">
                        <label class="form-check-label" for="brandDesign">Branding and Design</label>
                    </div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" id="hostingMaintenance">
                        <label class="form-check-label" for="hostingMaintenance">Hosting/Maintenance</label>
                    </div>
                </div>

            </div>


            <div class="div2">
                <h3 class="userRegTitle title">Work Experience</h3>
                <div class="form-floating mb-3 col-12 gx-2 gy-2">
                    <!-- Gap on all sides is 2 -->
                    <input type="text" id="companyName" name="companyName" class="form-control"
                        placeholder="Enter Company Name">
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
                        <input type="date" id="dateStarted" name="dateStarted" class="form-control"
                            placeholder="Enter Date Started">
                        <label id="dateStartedLabel" for="dateStarted">Enter Date Started</label>
                    </div>

                    <div class="form-floating mb-3 col-6 gx-2 gy-2">
                        <input type="date" id="dateEnded" name="dateEnded" class="form-control"
                            placeholder="Enter Date Ended">
                        <label id="dateEndedLabel" for="dateEnded">Enter Date Ended</label>
                    </div>
                </div>

                <h3 class="jobDescription" for="comment">Job Description</h3>
                <div>
                    <textarea class="form-control" id="comment" rows="5" placeholder="Enter job description"></textarea>
                </div>
                <div class="d-grid mt-2 gap-2 d-md-flex justify-content-md-end">

                    <button type="submit" id="btnFreelanceProfile" class="btn btn-primary">
                        Continue
                    </button>
                    <button class="btn btn-secondary">
                        Clear
                    </button>
                </div>

            </div>
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



    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalUser">
                    Are you sure you want to log out?
                </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/freelance.js"></script>
</body>
</body>

</html>