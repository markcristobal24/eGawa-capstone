<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();
$account = new Account();
$account->fetch_account($_SESSION['email']);
$account->fetch_profile($_SESSION['email']);

// if (!isset($_SESSION['email'])) {
//     header('location: ../login.php');
//     die();
// }

$email = $_SESSION['email'];
$query = $db->connect()->prepare("SELECT * FROM account INNER JOIN profile ON account.account_id = profile.account_id WHERE account.email = :email");
$query->execute([':email' => $email]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/freelanceHome.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Freelance Home</title>

    <style>

    </style>

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
                        <input class="form-control me-2 search" type="search" id="search_post"
                            placeholder="Search a tag" aria-label="Search"
                            onkeyup="new Posts().search_post(this.value);">
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
                    <span class="titlePost">' . $post_title = strtoupper($row['post_title']) . '</span>
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
                        
                        <button id="viewPostBTN"  data-bs-toggle="modal" data-bs-target="#view-post-modal" onclick="new Posts().view_post('. $row['post_id'] .')">View Post</button>
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
                    <img id="userPic"
                        src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $fetch['imageProfile']; ?>"
                        alt="user profile" title="user profile">
                    <p id="userName">
                        <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>
                    </p>
                    <!-- <p id="userName">other info</p> -->
                </div>
            </div>
            <div class="userPost">
                <!-- <div class="userPostChild">
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
                </div> -->
            </div>
        </div>
    </div>

    <!-- MODAL FOR VIEW POST -->
    <div class="modal fade" id="view-post-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Post Title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="title">
                        <span class="label">Job:</span>
                        <span class="content" id="post_title">
                            Web Dev
                        </span>
                    </div>
                    <div class="author">
                        <span class="label">Author:</span>
                        <span class="content" id="post_author">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div class="category">
                        <span class="label">Category:</span>
                        <span class="content" id="category">
                            Web Dev
                        </span>
                    </div>
                    <div class="tags">
                        <span class="label">Tags:</span>
                        <span class="content" id="post_tags">
                            html
                        </span>
                    </div>
                    <div class="info">
                        <span class="locationPost" id="address">
                            Sulok, Bagna, Malolos
                        </span>
                        <span class="separator">&#8226;</span>
                        <span class="datePost" id="posted_date">Posted on
                            Jan 01, 1969
                        </span>
                    </div>
                    <p class="" id="post_description">
                        The Lorem ipum filling text is used by graphic designers, programmers and printers with the aim
                        of occupying the spaces of a website, an advertising product or an editorial production whose
                        final text is not yet ready.

                        This expedient serves to get an idea of the finished product that will soon be printed or
                        disseminated via digital channels.


                        In order to have a result that is more in keeping with the final result, the graphic designers,
                        designers or typographers report the Lorem ipsum text in respect of two fundamental aspects,
                        namely readability and editorial requirements.

                        The choice of font and font size with which Lorem ipsum is reproduced answers to specific needs
                        that go beyond the simple and simple filling of spaces dedicated to accepting real texts and
                        allowing to have hands an advertising/publishing product, both web and paper, true to reality.

                        Its nonsense allows the eye to focus only on the graphic layout objectively evaluating the
                        stylistic choices of a project, so it is installed on many graphic programs on many software
                        platforms of personal publishing and content management system.
                    </p>
                    <div class="rate">
                        <span class="label">Rate:</span>
                        <span class="content" id="rate">
                            P 169,00.00
                        </span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#apply-job-modal" id="applyjob_btn"
                        onclick="new Posts().apply_job(this.value);">Apply</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR APPLY JOB -->
    <div class="modal fade" id="apply-job-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Apply for this job?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body apply">
                    <form action="">
                        <div class="title">
                            <span class="label">Job Title:</span>
                            <span class="content" id="job_title">
                                Web Dev
                            </span>
                        </div>

                        <div class="title">
                            <span class="label">To:</span>
                            <span class="content"></span>
                            <span class="content" id="job_author">
                                John Paulo Sulitz
                            </span>
                        </div>

                        <div class="title">
                            <span class="label">Message:</span>
                            <div class="form-floating mt-1 mb-2">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Write your message...</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formFileSm" class="form-label label">Upload file</label>
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send</button>
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
    // const textarea = document.getElementById('description');

    // textarea.addEventListener('input', () => {
    //     textarea.style.height = 'auto'; 
    //     textarea.style.height = textarea.scrollHeight + 'px'; 
    // });
    </script>

    <script src="../js/script.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../classJS/Posts.js"></script>
    <!-- 
    <script src="../js/user.js"></script>
    
     -->

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>


</html>