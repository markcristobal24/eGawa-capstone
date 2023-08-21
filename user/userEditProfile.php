<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eGawa | Edit Profile</title>

    <!-- start -- links for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- end --links for fonts -->

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userEditProfile.css">
    <link rel="stylesheet" href="../css/notification.css">


</head>

<body>
    <?php //print_r($_SESSION); ?>
    <div class="toast_notif" id="toast_notif"></div>

    <div class="mainContainer">
        <div class="title">
            <span class="editTitle">Edit Profile</span>
        </div>
        <hr>
        <div class="formContainer">

            <form id="editProfile_form" method="POST" enctype="multipart/form-data">
                <div class="left">
                    <div class="leftChild">
                        <div class="imgCont">
                            <img id="imgUpload" class="imgUpload" src="" alt="">
                        </div>

                        <div class="input-group mb-3 mt-3">
                            <input type="file" class="form-control" name="new_profile" id="imageInput" accept="image/*"
                                onchange="editUserIMG(event)">
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="rightChild">
                        <div class="infoTitle">
                            <span class="personalInfoTitle">Personal Information</span>
                        </div>
                        <label for="addr">Address</label>
                        <input id="addr" type="text" value="" name="new_address" class="text">

                        <label for="uname">Username</label>
                        <input id="uname" type="text" value="" name="new_username" class="text">
                    </div>
                    <div class="btns">
                        <button class="submitBTN" type="button" id="update_profile"
                            onclick="new Account().update_uProfile();">Update</button>
                        <button class="backBTN" type="button" onclick="window.history.back();">Back</button>
                    </div>
                </div>
            </form>

        </div>
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
    <script src="../js/user.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
</body>
<script>
new Account().fetch_user();
</script>

</html>