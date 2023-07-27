
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/viewfreelancerprofile.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Freelancer profile</title>
    <style>


    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../img/eGAWAwhite.png" alt="Logo" id="logoImage"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="home1" class="nav-link" href="userHome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="about1" id="about" class="nav-link" href="aboutUs.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a id="userInbox" class="nav-link" href="userInbox.php">Messages</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="userOption" class="nav-link" href="#">Welcome,
                            <span>

                            </span></a>
                        <div class="dropdown-content">
                            <a href="freelanceChangeEmail.php">Change Email Address</a>
                            <a href="freelanceChangePass.php">Change Password</a>
                            <a href="">Edit Account</a>
                            <a id="logout1" href="#">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="containerViewFreelance">

    <div class="div2">
        <div class="containerCatalog">

        <div class="item">
            <div class="catalogImg">
                <img class="imgWork" src="../img/box.png">'
            </div>
            <div class="catalogTexts">
                <h3>No catalog to display</h3>
                <h4>The freelancer has not yet posted a catalog <br></h4>
            </div>
        </div>


        </div>
    </div>

    <div class="div1">
        <img id="freelancerPic" src="../img/profile.png" alt="user profile" title="user profile">
        <div id="freelancerMainInfo" class="toFlex">
            <div id="freelanceMainInfoInside" class="toMid">
                <h2 id="freelancerName">
                    John Paulo Sulit
                </h2>
                <img id="verifiedImg" src="../img/verified.png" alt="" title="Verified">
            </div>
        </div>
        <div class="freelanceUsernameContainer">
            <h4 id="freelanceUsername">
                @lethimcook
            </h4>
        </div>
        
        
        <div class="rating">
            <span class="star" data-value="1"></span>
            <span class="star" data-value="2"></span>
            <span class="star" data-value="3"></span>
            <span class="star" data-value="4"></span>
            <span class="star" data-value="5"></span>
        </div>

        <div class="toFlex">
            <div class="toMid">
                <a id="freelanceRating" href="">Ratings</a>
            </div>
        </div>

        <div  class="flexDiv" id="jobsAndRole1">Jobs and Roles:</div>
            <ul>
                <li>Web Developer</li>
                <li>Mobile Developer</li>
            </ul>
        <div class="flexDiv">
            <img src="../img/address.png" alt="" class="addressImg" height="20px">
            <div class="freelanceAddress">Bagna, Malolos, Bulacan</div>
        </div>
        <div class="flexDiv flexDivBot">
            <img src="../img/email.png" alt="" class="emailImg" height="20px">
            <div class="freelanceEmail">Sulitin@gmail.com</div>
        </div>

        <div class="toFlex freelanceButtons">
            <div class="toMid">
                <div id="viewMoreFreelance1" onclick="modalFreelanceViewMore()">View more</div>
                <div id="messageFreelance1">Message</div>
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
                <div class="modal-body" id="modalLogOutConfirmation"> <!-- Updated ID -->
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

        <!-- this modal is for freelance profile if you click "view more" -->
    <div class="modal " id="modalViewMore1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="titles" id="">User Profile</div>
                </div>

                <img id="freelancerPic" src="../img/profile.png" alt="user profile" title="user profile">
                <div id="freelancerMainInfo" class="toFlex">
                    <div id="freelanceMainInfoInside" class="toMid">
                        <h2 id="freelancerName">
                            John Paulo Sulit
                        </h2>
                        <img id="verifiedImg" src="../img/verified.png" alt="" title="Verified">
                    </div>
                </div>
                <div class="freelanceUsernameContainer">
                    <h4 id="freelanceUsername">
                        @lethimcook
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
                        Bagna, Malolos, Bulacan
                    </div>
                </div>
                <div class="flexDiv">
                    <img src="../img/email.png" alt="" class="emailImg" height="20px">
                    <div class="freelanceEmail">
                        sulitin@gmail.com
                    </div>
                </div>

                <div class="titles" id="jobsAndRole1">Jobs and Roles:</div>
                    <ul>
                        <li>Web Developer</li>
                        <li>Mobile Developer</li>
                    </ul>
                    <hr>
                <div class="titles">Work Experience</div>

                <div class="flexDiv" id="workExpi1">
                    <div class="companyNameModal1">Company Name:&nbsp;</div>
                    <div class="companyNameModal1Data">
                        
                    </div>
                </div>
                <div class="flexDiv">
                    <div class="dateStartedModal1">Date Started:&nbsp;</div>
                    <div class="dateStartedModal1Data">
                        
                    </div>
                </div>
                <div class="flexDiv">
                    <div class="dateEndedModal1">Date Ended:&nbsp;</div>
                    <div class="dateEndedModal1Data">
                        
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
                Lorem ipsum dolor sit amet . The graphic and typographic operators know this well, 
                in reality all the professions dealing with the universe of communication have a 
                stable relationship with these words, but what is it? Lorem ipsum is a dummy text without 
                any sense.
                </p>

                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" id="">
                        Report
                    </button> -->
                    <button type="button" class="btn btn-outline-danger">Report</button>
                    <button type="button" class="btn btn-secondary" id="cancelViewMore">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/script.js "></script>
    <script src="../js/userpovfreelance.js "></script>

</body>


</html>