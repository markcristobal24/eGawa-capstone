

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="userViewPost.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | View Post</title>

</head>

<body>


    <?php include "../other/navbar.php"; ?>

    <div class="containerUserHome">
        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <span class="viewPostTitle">
                    View Post
                </span>
            </div>

            <div class="containerLeft-Feed">

                <div class="containerPost">
                    <div class="title">
                        <span class="label">Job:</span>
                        <span class="content">Web Developer</span>
                    </div>
                    <div class="author">
                        <span class="label">Author:</span>
                        <span class="content">John Paulo Sulit</span>
                    </div>
                    <div class="info">
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span class="separator">&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>
                    <div class="category">
                        <span class="label">Category:</span>
                        <span class="content">Web Development</span>
                    </div>
                    <div class="tags">
                        <span class="label">Tags:</span>
                        <span class="content">#web, #css, #html</span>
                    </div>
                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo 
                        
                    </p>
                    <div class="rate">
                        <span class="label">Rate:</span>
                        <span class="content">69,000</span>
                    </div>
                    <div class="backButton">
                        <button id="back">Go Back</button>
                    </div>
                </div>

            </div>
            
        </div>

        <div class="containerRight">
            <!-- <div class="containerRight-Nav">

            </div> -->
            <div class="userProfile">
                <div class="userProfileChild">
                    <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">
                    <p id="userName">John Paulo Sulit</p>
                    <p id="userName">other info</p>
                </div>
            </div>
            <div class="userPost">

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



    <script src="../js/script.js "></script>
    <script src="../js/user.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    


</body>


</html>