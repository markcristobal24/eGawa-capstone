<?php
// session_start();
// if (!isset($_SESSION['account_id'])) {
//     header('location: ../login.php');
//     die();
// } else if ($_SESSION['userType'] !== "user") {
//     header('location: ../freelance/freelanceHome.php');
//     die();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | ID Verification</title>

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
    <!-- <link rel="stylesheet" href="../css/userEditProfile.css"> -->
    <link rel="stylesheet" href="id_verification.css">
    <link rel="stylesheet" href="css/notification.css">


</head>

<body>
    <div class="toast_notif" id="toast_notif"></div>

    <!-- <div class="container d-flex main- flex-wrap">
        <div class="container container-one">
            <form class="container_ container" id="idverify_form" enctype="multipart/form-data">
                <div class="cont-dflex">

                    <div class="container-left">
                        <h1 class="white- header_title">Upload ID</h1>
                        <select id="id-dropdown" name="id_type">
                            <option value="none">Pick an ID type</option>
                            <option value="umid">UMID</option>
                            <option value="drive">Drivers License</option>
                            <option value="philhealth">Philhealth Card</option>
                            <option value="sss">SSS ID</option>
                            <option value="passport">Passport</option>
                            <option value="tin">TIN ID</option>
                            <option value="voters">Voters ID</option>

                        </select>
                        <div id="id-box">
                            <img id="id-image" src="" alt="ID Image">
                        </div>
                    </div>

                    <div class="container-right">
                        <div class="id-front">
                            <label for="front-id" class="white-">Front ID Image</label>
                            <input type="file" id="front-id" name="front_id" accept="image/*" required>
                        </div>
                        <div class="id-back mt-3">
                            <label for="back-id" class="white-">Back ID Image</label>
                            <input type="file" id="back-id" name="back_id" accept="image/*" required>
                        </div>
                    </div>

                </div>

                <div class="input-group flex-nowrap mt-3 mb-3">
                    <span class="input-group-text" id="addon-wrapping">ID Number: </span>
                    <input type="text" class="form-control" name="id_number" placeholder="Enter ID number" aria-describedby="addon-wrapping">
                </div>

                <div class="container-bottom">
                    <div class="bot-top">
                        <input type="checkbox" id="">
                        <span class="white- hereby">I hereby declare that the information contained in this form is complete,
                            valid and truthful</span>
                    </div>
                    <div class="bot-bot mt-3">
                        <button type="button" class="btn btn-primary" id="btn_verifyID" onclick="new Account().id_verify();">Send</button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="container container-two">
            <div>
                <img src="img/tin.png" alt="">
            </div>
            <div>
                <img src="img/tin.png" alt="">
            </div>

        </div>

    </div> -->



    <div class="container main-">
        <div class="row p-3">
            <h1 class="white- header_title">Upload ID</h1>
            <div class="col-md-6 d-flex justify-content-center">
                <!-- First Child Div -->
                <div class="child-div">
                    <!-- Content for the first child div -->
                    <label for="" class="white- mb-1">Front ID</label>
                    <div class="mb-3">
                        <!-- <img class="img-id" src="img/imgup.png" alt=""> -->

                        <img class="img-id" id="uploaded-img-front" src="img/id-card.png" alt="">
                    </div>
                    <label for="" class="white- mb-1">Back ID</label>
                    <div clas="">

                        <img class="img-id" id="uploaded-img-back" src="img/id-card.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <!-- Second Child Div -->
                <div class="child-div">
                    <!-- Content for the second child div -->

                    <form action="" id="idverify_form" enctype="multipart/form-data">


                        <div class="container mt-3 mt-sm-1">

                            <label for="id-dropdown" class="white- mb-1">Select ID Type</label>

                            <select id="id-dropdown" name="id_type" class="form-select form-select-sm mb-3"
                                aria-label="Large select example">
                                <option selected value="none">Pick an ID type</option>
                                <option value="umid">UMID</option>
                                <option value="drive">Drivers License</option>
                                <option value="philhealth">Philhealth Card</option>
                                <option value="sss">SSS ID</option>
                                <option value="passport">Passport</option>
                                <option value="tin">TIN ID</option>
                                <option value="voters">Voters ID</option>
                            </select>

                            <div class="container d-flex justify-content-start" id="id-box">
                                <img id="id-image" src="img/imgup.png" alt="ID Image">
                            </div>
                        </div>

                        <div class="container mb-2">

                            <label for="front-id" class="white- mb-1">Front ID Image</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="front-id" name="front_id"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="image/*"
                                    required>
                            </div>

                            <label for="back-id" class="white- mb-1">Back ID Image</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="back-id" name="back_id"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="image/*"
                                    required>
                            </div>

                            <label for="" class="white- mb-1">ID Number</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping">ID Number: </span>
                                <input type="text" class="form-control" name="id_number" placeholder="Enter ID number"
                                    aria-describedby="addon-wrapping">
                            </div>

                        </div>


                        <div class="container">
                            <div class="bot-top">
                                <input type="checkbox" id="id_checkbox">
                                <span class="white- hereby">I hereby declare that the information contained in this form
                                    is complete,
                                    valid and truthful</span>
                            </div>
                            <div class="bot-bot mt-3">
                                <button type="button" class="btn btn-primary" id="btn_verifyID"
                                    onclick="new Account().id_verify();" disabled>Send</button>
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back()">Back</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
    <script src="js/user.js"></script>
    <script src="classJS/Account.js"></script>
    <script src="classJS/Notification.js"></script>
</body>
<script>
const idDropdown = document.getElementById("id-dropdown");
const idImage = document.getElementById("id-image");

idDropdown.addEventListener("change", function() {
    const selectedId = idDropdown.value;
    if (selectedId === "none") {
        idImage.src = "img/imgup.png";
        idImage.alt = "Pick An ID Type";
    } else {

        const imageSources = {
            umid: "img/umid.png",
            drive: "img/drivers.jpg",
            philhealth: "img/philhealth.png",
            sss: "img/umid.png",
            passport: "img/passport.png",
            tin: "img/tin.png",
            voters: "img/voters.png",
        };

        if (imageSources[selectedId]) {
            idImage.src = imageSources[selectedId];
            idImage.alt = selectedId.charAt(0).toUpperCase() + selectedId.slice(1);
        }
    }
});

document.getElementById('front-id').addEventListener('change', function() {
    var fileInputF = document.getElementById('front-id');
    var uploadedImgF = document.getElementById('uploaded-img-front');

    var file = fileInputF.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            uploadedImgF.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById('back-id').addEventListener('change', function() {
    var fileInputB = document.getElementById('back-id');
    var uploadedImgB = document.getElementById('uploaded-img-back');


    var file = fileInputB.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            uploadedImgB.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});

let id_checkbox = document.getElementById('id_checkbox');
id_checkbox.addEventListener('change', function() {
    if (id_checkbox.checked == true) {
        console.log(id_checkbox.checked);
        console.log('eyy');
        document.getElementById('btn_verifyID').disabled = false;
    } else {
        console.log(id_checkbox.checked);
        document.getElementById('btn_verifyID').disabled = true;
    }
});
</script>

</html>