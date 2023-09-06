<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();

$user_id = $_SESSION['account_id'];
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
$query->execute([':account_id' => $user_id]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);
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

    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <title>eGawa | User Home</title>

    <!-- <script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('7717fc588fb67a40c2c6', {
        cluster: 'ap1'
    });
    pusher.connection.bind('connected', () => {
        console.log('pusher is connected');
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
        let a = JSON.stringify(data);
        console.log(a);
        window.location.reload();
    });
    </script> -->

</head>

<body>
    <?php //print_r($_SESSION); ?>
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
                                <option value="Website Development">Website Development</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Website Hosting">Website Hosting</option>
                                <option value="Multimedia">Multimedia</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="left-nav-search">
                    <form class="d-flex">
                        <input class="form-control me-2 search" type="text" id="search_post"
                            onkeyup="new Posts().search_post(this.value);" placeholder="Search a tag"
                            aria-label="Search">
                        <!-- <button class="btn btn-success" type="submit">Search</button> -->
                    </form>
                </div>
            </div>

            <div class="containerLeft-Feed" id="post_container">
                <?php
                $query = $db->connect()->prepare("SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id ORDER BY posted_date DESC");
                 $query->execute();
                // $fetch_post = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id ORDER BY posted_date DESC");
                foreach ($query as $row) {
                    $currentDateTime = $row['posted_date'];
                    $dateTimeObj = new DateTime($currentDateTime);
                    $posted_date = $dateTimeObj->format("F d, Y h:i A");

                    echo ' <div class="containerPost">
                    <span class="titlePost">' . $post_title = strtoupper($row['post_title']). '</span>
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
                        <button id="viewPostBTN" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                    </div>
                </div> ';
                }
                if ($query->rowCount() <= 0) {
                    echo '<div class="noResult">
                                <div class="noResultIMG">
                                    <img id="noIMG" src="../img/search.png" alt="">
                                </div>
                                <div class="noResultText">
                                    <span>
                                    No post available
                                    </span>
                                </div>
                            </div>';
                }
                ?>
            </div>

        </div>

        <div class="containerRight">
            <!-- <div class="containerRight-Nav">

            </div> -->
            <div class="userProfile">
                <div class="userProfileChild">
                    <img id="userPic" <?php
                        if (isset($_SESSION['user_image'])) {
                            ?>
                        src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $_SESSION['user_image']; ?>" <?php
                        } else {
                            ?> src="../img/profile.png" <?php
                        }
                    ?> alt="user profile" title="user profile">
                    <p id="userName">
                        <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>
                    </p>
                    <!-- <p id="userName">other info</p> -->
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
                                    <option value="Website Development">Website Development</option>
                                    <option value="Mobile Development">Mobile Development</option>
                                    <option value="Website Hosting">Website Hosting</option>
                                    <option value="Multimedia">Multimedia</option>
                                </select>
                            </div>
                        </div>

                        <input type="text" id="title" name="post_title" placeholder="Job Title" required>

                        <div class="descContainer">
                            <textarea id="description" placeholder="Job Description" name="post_description"></textarea>
                        </div>

                        <input type="text" id="tags" name="post_tags" placeholder="Tags" required>

                        <div class="rateInput input-group mb-3 mt-2">

                            <span class="input-group-text">&#8369;</span>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                name="rate" placeholder="Enter rate" required>
                            <span class="input-group-text">.00</span>
                        </div>

                        <div class="btns">
                            <input id="submitPost" class="btn" type="button" value="Submit"
                                onclick="new Posts().post();">
                            <input id="clearPost" class="btn" type="button" value="Clear">
                        </div>
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

    <script>
    // JavaScript to make the textarea auto-resize
    const textarea = document.getElementById('description');

    textarea.addEventListener('input', () => {
        textarea.style.height = 'auto'; // Reset height to auto
        textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scrollHeight
    });
    </script>


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