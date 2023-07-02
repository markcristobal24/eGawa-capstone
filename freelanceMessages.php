
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelanceMessages.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
 

    <title>eGawa | Freelance Messages</title>

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


        <div class="div1">
            <img id="freelancerPic" src="img/profile.png" alt="user profile" title="user profile">
            <h2 id="freelanceName"></h2>
            <div id="verifyFreelanceAcc">Verify Account</div>
            <div id="jobsAndRole1">Jobs and Roles:</div>
            <ul>
                <!-- <li class="job one">Sample Job1</li>
                <li class="job two"></li>
                <li class="job three"></li>
                <li class="job four"></li>
                <li class="job five"></li> -->
            </ul>

            <div class="flexDiv">
                <img src="img/address.png" alt="" class="addressImg" height="20px">
                <div class="freelanceAddress"></div>
            </div>
            <div class="flexDiv">
                <img src="img/email.png" alt="" class="emailImg" height="20px">
                <div class="freelanceEmail"></div>
            </div>
            <div id="viewmore">View More</div>
            <div>

            </div>
            <div class="editContainer">
                <div id="editFreelanceAcc">Edit Account</div>
            </div>
        </div>

        <div class="div2">
            <h2>freelance Project catalog</h2>
            <p>Rinespeto na nga kita eh. Pero anong ginawa mo? Tiger. Tiger, alam ko pero hindi ako rinespeto tiger.
                Isipin mo 'yon, tiger. Hindi ako rinespeto tiger. Mukha lang akong makasalanan, mukha lang akong
                lasinggero. Pero ginawa akong lasingero! Tiger isipin mo 'yon. Isipin mo 'yon, tiger. Ginawa akong
                lasinggero ng titser na yan?! Ha?! Ano?! Ginawa akong lasinggero niyan... pare isipin mo 'yun tiger.
                Ginawa akong lasinggero ng tarantado na 'yan. Isipin mo, tiger, isipin mo! Tignan mo! Tiger... Tiger
                hindi ako lasing. Tiger hindi ako lasing.</p>

            <p>Rinespeto na nga kita eh. Pero anong ginawa mo? Tiger. Tiger, alam ko pero hindi ako rinespeto tiger.
                Isipin mo 'yon, tiger. Hindi ako rinespeto tiger. Mukha lang akong makasalanan, mukha lang akong
                lasinggero. Pero ginawa akong lasingero! Tiger isipin mo 'yon. Isipin mo 'yon, tiger. Ginawa akong
                lasinggero ng titser na yan?! Ha?! Ano?! Ginawa akong lasinggero niyan... pare isipin mo 'yun tiger.
                Ginawa akong lasinggero ng tarantado na 'yan. Isipin mo, tiger, isipin mo! Tignan mo! Tiger... Tiger
                hindi ako lasing. Tiger hindi ako lasing.</p>

        </div>
    </div>


    <!-- this modal is for freelance profile if you click "view more" -->
    <div class="modal fade" id="modalViewMore" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="titles" id="modalTitleViewMore">User Profile</div>
                </div>

                <img id="freelancerPic" src="img/profile.png" alt="user profile" title="user profile">
                <h2 id="freelanceName">Freelance Name</h2>

                <div class="flexDiv">
                    <img src="img/address.png" alt="" class="addressImg" height="20px">
                    <div class="freelanceAddress">Sto.Nino, Hagonoy, Bulacan</div>
                </div>
                <div class="flexDiv">
                    <img src="img/email.png" alt="" class="emailImg" height="20px">
                    <div class="freelanceEmail">sample@gmail.com</div>
                </div>
                
                <div class="titles">Jobs and Roles:</div>
                <ul>
                    <li class="job one">Sample Job1</li>
                    <li class="job two"></li>
                    <li class="job three"></li>
                    <li class="job four"></li>
                    <li class="job five"></li>
                </ul>

                <hr>
                <div class="titles">Work Experience</div>
                <div class="flexDiv" id="workExpi1">
                    <div class="companyNameModal1">Company Name: </div>
                    <div class="companyNameModal1Data">Example Company</div>
                </div>
                <div class="flexDiv">
                    <div class="dateStartedModal1">Date Started: </div>
                    <div class="dateStartedModal1Data">December 1, 2000</div>
                </div>
                <div class="flexDiv">
                    <div class="dateEndedModal1">Date Ended: </div>
                    <div class="dateEndedModal1Data">February 1, 2010</div>
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
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias corrupti ipsum suscipit cupiditate
                    iusto
                    quas doloribus eum repellat, pariatur aperiam molestiae itaque fugit laborum placeat dolor
                    accusantium
                    dolores iste architecto?
                </p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelViewMore">
                        Close
                    </button>
                </div>
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
    <script src="js/script.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/freelance.js"></script>
</body>
</body>

</html>