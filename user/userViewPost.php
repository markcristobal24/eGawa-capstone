<?php
session_start();

if (isset($_GET['data'])) {
    $encodedData = $_GET['data'];
    $decodedData = json_decode(urldecode($encodedData), true);
    $post_title = $decodedData['post_title'];
    $author = $decodedData['firstName'] . ' ' . $decodedData['lastName'];
    $category = $decodedData['category'];
    $post_tags = $decodedData['post_tags'];
    $address = $decodedData['address'];
    $posted_date = $decodedData['posted_date'];
    $post_description = $decodedData['post_description'];
    $rate = $decodedData['rate'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userViewPost.css">

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
                        <span class="content" id="post_title">
                            <?php echo $post_title; ?>
                        </span>
                    </div>
                    <div class="author">
                        <span class="label">Author:</span>
                        <span class="content" id="post_author">
                            <?php echo $author; ?>
                        </span>
                    </div>
                    <div class="category">
                        <span class="label">Category:</span>
                        <span class="content" id="category">
                            <?php echo $category; ?>
                        </span>
                    </div>
                    <div class="tags">
                        <span class="label">Tags:</span>
                        <span class="content" id="post_tags">
                            <?php echo $post_tags; ?>
                        </span>
                    </div>
                    <div class="info">
                        <span class="label">Date & Time:</span>
                        <span class="locationPost" id="address">
                            <?php echo $address; ?>
                        </span>
                        <span class="separator">&#8226;</span>
                        <span class="datePost" id="posted_date">Posted on
                            <?php echo $posted_date; ?>
                        </span>
                    </div>
                    <p class="descPost" id="post_description">
                        <?php echo $post_description; ?>
                    </p>
                    <div class="rate">
                        <span class="label">Rate:</span>
                        <span class="content" id="rate">
                            <?php echo $rate; ?>
                        </span>
                    </div>
                    <div class="backButton">
                        <button id="back"><a href="userHome.php" id="backAnchor">Go Back</a></button>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>