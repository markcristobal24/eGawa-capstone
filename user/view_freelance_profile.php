<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();
$account = new Account();
$account->fetch_account($_SESSION['email']);
$account->fetch_profile($_SESSION['email']);

if (!isset($_SESSION['email'])) {
    header('location: ../login.php');
    die();
}

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
    <link rel="stylesheet" href="../css/view_freelance_profile.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery-bundle.css'>



    <title>eGawa | <!-- freelancer's name --> </title>
</head>

<body>
    <?php //print_r($_SESSION); ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>
    <div class="containerUserHome">

        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <span class=catalogNavtitle>Catalogs</span>
                <div class="left-nav">

                </div>
            </div>

            <div class="containerLeft-Feed" id="post_container">
                <?php
                $query = $db->connect()->prepare("SELECT * FROM catalog WHERE email = :email ORDER BY date_created DESC");
                $query->execute([':email' => $email]);
                if ($query->rowCount() > 0) {
                    foreach ($query as $row) {
                        $catalog_id = $row['catalog_id'];
                        ?>
                <div class="containerPost">
                    <div class="containerImg">
                        <img src="https://res.cloudinary.com/dm6aymlzm/image/upload/<?php echo $row['catalogImage']; ?>"
                            alt="" id="containerImg">
                    </div>
                    <div class="containerCatalog">
                        <span class="titlePost"><?php echo $row['catalogTitle']; ?></span>
                        <p class="descPost"><?php echo $row['catalogDescription']; ?></p>
                        <div>
                            <button type="button" id="viewPostBTN" class="" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                onclick="new Catalog().view_catalogs(<?php echo $catalog_id; ?>);">View Catalog</button>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="containerPost">';

                        echo '<div class="catalogImg">';
                        echo '<img class="imgWork" src="../img/box.png">';
                        echo '</div>';

                        echo '<div class="catalogTexts">';
                        echo '<h3>No catalog to display</h3>';
                        echo '<p>There is no catalog available at the moment. <br> Freelancer has not yet added a catalog</p>';
                        echo '</div>';

                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="containerRight">
            <div class="userProfile">
                <div class="userProfileChild" id="userProfileChild">
                    <a class="userPic"
                        href="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $fetch['imageProfile']; ?>">
                        <img id="userPic"
                            src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $fetch['imageProfile']; ?>"
                            alt="user profile" title="user profile">
                    </a>


                    <p id="userName">
                        <?php echo $fullname; ?>
                    </p>

                    <p id="freelanceUsername">
                        <?php echo "@".$fetch['username']; ?>
                    </p>

                    <div class="rating">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>

                    <div id="jobsAndRole1">Jobs and Roles:</div>
                    <ul>
                        <?php
                            $query = $db->connect()->prepare("SELECT * FROM profile WHERE email = :email");
                            $query->execute([':email' => $email]);
                            // $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                            if ($query->rowCount() > 0) {
                                $roleValues = array();

                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    $values = explode(',', $row['jobRole']);
                                    $roleValues = array_merge($roleValues, $values);
                                }

                                foreach ($roleValues as $value) {
                                    echo "<li>$value</li>";
                                }
                            }
                            ?>
                    </ul>

                    <div class="flexDiv">
                        <img src="../img/address.png" alt="" class="addressImg" height="20px">
                        <div class="freelanceAddress marg">
                            <?php echo $fetch['address']; ?>
                        </div>
                    </div>

                    <div class="flexDiv">
                        <img src="../img/email.png" alt="" class="emailImg" height="20px">
                        <div class="freelanceEmail marg">
                            <?php echo $fetch['email']; ?>
                        </div> 
                    </div>

                    <button class="mt-3" data-bs-toggle="modal" data-bs-target="#view_profile">View More</button>

                </div>
            </div>
        </div>


    </div>


    <!-- Modal for view catalog-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-view-catalog">
                    <div class="containerImg">
                        <img id="catalogImage" src="../img/work2.png" alt="">
                    </div>
                    <hr>
                    <h1 class="modal-title fs-5 titles" id="">Description</h1>
                    <div class="container-description" id="container-description">
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#edit-catalog-modal">Edit</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#confirm-delete-modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for view profile-->
    <div class="modal fade" id="view_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-view-more">
                        <div class="modal-pic-container">
                            <img id="userPic"
                                src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_jpg/r_max/<?php echo $fetch['imageProfile']; ?>"
                                alt="user profile" title="user profile">
                        </div>

                        <div class="modal-name-container">
                            <p id="userName">
                                <?php echo $fullname; ?>
                            </p>
                        </div>

                        <p id="freelanceUsername">
                            <?php echo "@".$fetch['username']; ?>
                        </p>

                        <div class="flexDiv">
                            <img src="../img/address.png" alt="" class="addressImg" height="20px">
                            <div class="freelanceAddress marg">
                                <?php echo $fetch['address']; ?>
                            </div>
                        </div>

                        <div class="flexDiv">
                            <img src="../img/email.png" alt="" class="emailImg" height="20px">
                            <div class="freelanceEmail marg">
                                <?php echo $fetch['email']; ?>
                            </div>
                        </div>

                        <div class="rating">
                            <span class="star" data-value="1"></span>
                            <span class="star" data-value="2"></span>
                            <span class="star" data-value="3"></span>
                            <span class="star" data-value="4"></span>
                            <span class="star" data-value="5"></span>
                        </div>

                        <div id="" class="titles">
                            Jobs and Roles:
                        </div>

                        <ul>
                            <?php
                                $query = $db->connect()->prepare("SELECT * FROM profile WHERE email = :email");
                                $query->execute([':email' => $email]);
                                // $query = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email'");
                                if ($query->rowCount() > 0) {
                                    $roleValues = array();

                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        $values = explode(',', $row['jobRole']);
                                        $roleValues = array_merge($roleValues, $values);
                                    }

                                    foreach ($roleValues as $value) {
                                        echo "<li>$value</li>";
                                    }
                                }
                            ?>
                        </ul>
                        <div>
                            <div class="titles">
                                Work Experience
                            </div>
                            <div>
                                <div>
                                    <span>Company Name: </span> <span><?php echo $fetch['companyName']; ?></span>
                                </div>
                                <div>
                                    <span>Date Started: </span> <span><?php
                        $date = $fetch['startDate'];
                        $dateObj = new DateTime($date);
                        $startDate = $dateObj->format("F d, Y");
                        echo $startDate;
                        ?></span>
                                </div>
                                <div>
                                    <span>Date Ended: </span> <span><?php
                        $date = $fetch['endDate'];
                        $dateObj = new DateTime($date);
                        $endDate = $dateObj->format("F d, Y");
                        echo $endDate; ?></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="titles">
                                Job Description
                            </div>
                            <div>
                                <span>
                                    <?php echo $fetch['jobDescription']; ?>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#hey">Edit</button> -->
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

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    </div>

    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.min.js'>
    </script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/video/lg-video.umd.js'></script>


    <script src="../js/createNewDiv.js"></script>
    <script src="../classJS/Catalog.js"></script>
    <script src="../classJS/Account.js"></script>
    <script src="../classJS/Notification.js"></script>
    <script src="../js/script.js"></script>
    <!-- <script src="../js/validate.js"></script> -->
    <script src="../js/freelance.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    let counter = 0;
    if (counter <= 0) {
        lightGallery(document.getElementById('userProfileChild'), {
            counter: false,
            download: true,
            backdropDuration: 100,
            selector: 'a',
            controls: false,
            escKey: true
        });
        counter++;
    }
    </script>
</body>

</html>