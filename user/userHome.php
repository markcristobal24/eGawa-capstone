<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userHome.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | User Home</title>

</head>

<body>
    <?php print_r($_SESSION); ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>
    <div class="containerUserHome">
        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <div class="left-nav-dropdown">
                    <div class="dropdownOption">
                        <form id="filterpost_form" method="POST">
                            <select id="filterOption" name="filterOption"
                                onchange="new Posts().filter_post(this.value);">
                                <option value="all">All</option>
                                <option value="webdev">Website Development</option>
                                <option value="mobiledev">Mobile Development</option>
                                <option value="webhost">Website Hosting</option>
                                <option value="multi">Multimedia</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="left-nav-search">
                    <form class="d-flex">
                        <input class="form-control me-2 search" type="search" placeholder="Search a tag"
                            aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="containerLeft-Feed" id="post_container">
                <?php
                $fetch_post = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id ORDER BY posted_date DESC");
                foreach ($fetch_post as $row) {
                    $currentDateTime = $row['posted_date'];
                    $dateTimeObj = new DateTime($currentDateTime);
                    $posted_date = $dateTimeObj->format("F d, Y h:i A");

                    echo ' <div class="containerPost">
                    <span class="titlePost">' . $row['post_title'] . '</span>
                    <div>
                        <span class="author">Author: </span>
                        <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                    </div>
                    <div>
                        <span class="locationPost">' . $row['address'] . '</span>
                        <span>•</span>
                        <span class="datePost">Posted on ' . $posted_date . '</span>
                    </div>

                    <p class="descPost">
                        ' . $row['post_description'] . '
                    </p>
                    <div>
                        <button id="viewPostBTN">View Post</button>
                    </div>
                </div> ';
                }
                ?>
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
                <div class="userPostChild">
                    <div class="toFlex">
                        <p class="postTitle">Post a Job</p>
                    </div>

                    <form id="post_form" method="POST">
                        <div class="toFlex">
                            <div class="dropdownOptionPost">
                                <select id="filterOptionPost" name="post_category">
                                    <option value="webdev">Website Development</option>
                                    <option value="mobiledev">Mobile Development</option>
                                    <option value="webhost">Website Hosting</option>
                                    <option value="multi">Multimedia</option>
                                </select>
                            </div>
                        </div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="post_title" required>

                        <label for="description">Description:</label>
                        <!-- <input type="text" id="description" name="description" required><br> -->
                        <textarea id="description" name="post_description" rows="3" required></textarea>

                        <label for="tags">Tags:</label>
                        <input type="text" id="tags" name="post_tags">

                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text">&#8369;</span>
                            <!-- <select id="currency" name="" >
                                <option value="dollar">&#36; Dollar</option>
                                <option value="peso">&#8369; Peso</option>
                            </select> -->

                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                name="rate" required>
                            <span class="input-group-text">.00</span>
                        </div>

                        <input id="submitPost" type="button" value="Submit" onclick="new Posts().post();">
                        <input id="clearPost" type="button" value="Clear">
                    </form>
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
    <!-- 
    <script>
        window.onload = func tion() {
            updateDivContent();
        };

        function updateDivContent() {
            var selectedOption = document.getElementById("filterOption").value;

            if (selectedOption === 'webdev') {
                option1Div.style.display = 'block';
                option2Div.style.display = 'none';
                option3Div.style.display = 'none';
                option4Div.style.display = 'none';



            } else if (selectedOption === 'mobiledev') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'block';
                option3Div.style.display = 'none';
                option4Div.style.display = 'none';


            } else if (selectedOption === 'webhost') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'none';
                option3Div.style.display = 'block';
                option4Div.style.display = 'none';


            } else if (selectedOption === 'multi') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'none';
                option3Div.style.display = 'none';
                option4Div.style.display = 'block';
                btn.innerText = 'Multimedia';

            }
        }

        function changeOption(option) {
            const btn = document.getElementById('dropdownBTN');
            const option1Div = document.getElementById('option1Div');
            const option2Div = document.getElementById('option2Div');
            const option3Div = document.getElementById('option3Div');
            const option4Div = document.getElementById('option4Div');

            if (option === 'Option 1') {
                option1Div.style.display = 'block';
                option2Div.style.display = 'none';
                option3Div.style.display = 'none';
                option4Div.style.display = 'none';
                btn.innerText = 'Website Development';

            } else if (option === 'Option 2') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'block';
                option3Div.style.display = 'none';
                option4Div.style.display = 'none';
                btn.innerText = 'Mobile Development';

            } else if (option === 'Option 3') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'none';
                option3Div.style.display = 'block';
                option4Div.style.display = 'none';
                btn.innerText = 'Website Hosting';

            } else if (option === 'Option 4') {
                option1Div.style.display = 'none';
                option2Div.style.display = 'none';
                option3Div.style.display = 'none';
                option4Div.style.display = 'block';
                btn.innerText = 'Multimedia';

            }
        }

        function changeOptionPost(optionPost) {
            const btnPost = document.getElementById('dropdownBTNPost');


            if (optionPost === 'Option 1') {

                btnPost.innerText = 'Website Development';

            } else if (optionPost === 'Option 2') {

                btnPost.innerText = 'Mobile Development';

            } else if (optionPost === 'Option 3') {

                btnPost.innerText = 'Website Hosting';

            } else if (optionPost === 'Option 4') {

                btnPost.innerText = 'Multimedia';

            }
        }
    </script> -->


    <script src="../js/script.js "></script>
    <script src="../js/user.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Posts.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>