<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();
$account = new Account();
$account->fetch_account($_SESSION['email']);
$account->fetch_profile($_SESSION['email']);

if (!isset($_SESSION['account_id'])) {
    header('location: ../login.php');
    die();
} else if ($_SESSION['userType'] !== "freelancer") {
    header('location: ../user/userHome.php');
    die();
}

$email = $_SESSION['email'];
$query = $db->connect()->prepare("SELECT * FROM account INNER JOIN profile ON account.account_id = profile.account_id WHERE account.email = :email");
$query->execute([':email' => $email]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/freelance_message.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link rel="shortcut icon" href="../img/egawaicon4.png" type="image/x-icon">
    <title>eGawa | Messages</title>

    <script>
    Pusher.logToConsole = true;
    const pusher = new Pusher('1e64e7913006b4f715d3', {
        cluster: 'ap1',
        encrypted: true
    });
    </script>

</head>

<body>


    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>

    <div id="container2">

        <!-- Menu Tab -->
        <div class="menu_container">
            <ul class="tab_navigation">
                <li>Messages</li>
                <li>Job Application</li>
            </ul>
        </div>

        <!-- First Tab -->
        <div class="tab_container_area">
            <div class="tab_container">

                <div class="chat-container">

                    <div class="left-chat-cont chats">
                        <?php
                        $query = $db->connect()->prepare("SELECT * FROM convo 
                        INNER JOIN account on account.account_id = convo.user_id
                        WHERE convo.freelance_id = :account_id OR convo.user_id = :account_id ORDER BY timestamp ASC");
                        $query->execute([
                            ':account_id' => $_SESSION['account_id']
                        ]);
                        foreach ($query as $row) {
                            $convo_id = $row['convo_id'];
                            echo '
                            <div class="user-post" onclick="clickConvo(' . $convo_id . ')">
                                <div class="user-image">
                                ';
                            if ($row['user_image'] == "") {
                                echo  '<img src="../img/profile.png" alt="" class="user-chat-img">';
                            } else {
                                echo '<img src="../img/uploads/company/' . $row['user_image'] . '" alt="" class="user-chat-img">';
                            }
                            echo '     
                                </div>
                                <div class="user-info">
                                    <span class="fname-">' . $row['firstName'] . '</span>
                                    <span class="mname-"></span>
                                    <span class="lname-">' . $row['lastName'] . '</span>
                                </div>
                            </div>
                            ';
                        }
                        ?>

                    </div>

                    <div class="middle-chat-cont chats">

                        <div class="middle-chat-nav">
                            <img src="../img/profile.png" id="chat_image" alt="" class="user-chat-img chat-box-img">
                            <span id="fullname"></span>
                        </div>

                        <div class="middle-chat-box" id="chatbox">

                        </div>

                        <div class="middle-chat-send">

                            <div id="inputDiv">
                                <form id="message_box">
                                    <textarea id="inputTextarea" name="messageInput" rows="3" cols="50"
                                        placeholder="Enter your message here..."></textarea>
                                    <div class="button-container">
                                        <button type="button" id="btn_sendMessage" onclick="send_message(this.value)"
                                            class="btn btn-primary">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="right-chat-cont">
                        <div class="profile-pic">
                            <img src="../img/profile.png" id="profile_image" alt="" class="user-chat-img right-pic">
                        </div>
                        <div class="profile-info block">
                            <span class="block" id="profile_name"></span>
                            <span class="block" id="user_name"></span>
                            <div>
                                <img src="../img/email.png" alt="" class="emailImg" height="20px">
                                <span class="block" id="profile_email"></span>
                            </div>

                            <div>
                                <img src="../img/address.png" alt="" class="addressImg" height="20px">
                                <span class="block" id="profile_address"></span>
                            </div>

                            <div>
                                <button type="button" id="btn_viewProfile" class="btn btn-primary view_profile mt-3"
                                    style="display: none;" onclick="view_profile(this.value)">View Profile</button>
                            </div>
                            <div>
                                <button type="button" id="btn_report" class="btn btn-danger view_profile mt-3"
                                    data-bs-toggle="modal" data-bs-target="#report-modal"
                                    style="display: none;">Report</button>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

            <div class="tab_container">

                <div class="col-names">
                    <div class="col-name">
                        <span>Pending</span>
                    </div>

                    <div class="col-name">
                        <span>Accepted</span>
                    </div>

                    <div class="col-name">
                        <span>Completed</span>
                    </div>
                </div>

                <div class="col-container">

                    <div class="col-one col-all">
                        <?php
                        $query = $db->connect()->prepare("SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.user_id = account.account_id
                                WHERE job_application.freelance_id = :account_id AND job_application.jobstatus = 'PENDING' ORDER BY timestamp DESC");
                        $query->execute([':account_id' => $_SESSION['account_id']]);
                        foreach ($query as $row) {
                            echo '
                                <div class="parent" data-bs-toggle="modal" data-bs-target="#modal-view-job-app" onclick="new Job().view_job_freelance(' . $row['application_id'] . ', \'PENDING\')">
                                    <div class="child left">
                                        <span class="name-info">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <span class="job-type">' . $row['post_title'] . '</span>
                                    </div>
                                    <div class="child right">
                                        <span class="status status-1">
                                        ' . $row['jobstatus'] . '
                                        </span>
                                    </div>
                                </div>
                                ';
                        }
                        ?>
                    </div>


                    <div class="col-two col-all">
                        <?php
                        $query = $db->connect()->prepare(
                            "SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.user_id = account.account_id
                                WHERE job_application.freelance_id = :account_id AND job_application.jobstatus = 'ONGOING' ORDER BY timestamp DESC"
                        );
                        $query->execute([
                            ':account_id' => $_SESSION['account_id']
                        ]);
                        foreach ($query as $row) {
                            echo '
                                <div class="parent" data-bs-toggle="modal" data-bs-target="#modal-view-job-app" onclick="new Job().view_job_freelance(' . $row['application_id'] . ', \'ONGOING\')">
                                    <div class="child left">
                                        <span class="name-info">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <span class="job-type">' . $row['post_title'] . '</span>
                                    </div>
                                    <div class="child right">
                                        <span class="status status-2">
                                        ' . $row['jobstatus'] . '
                                        </span>
                                    </div>
                                </div>
                                ';
                        }
                        ?>
                    </div>

                    <div class="col-three col-all">
                        <?php
                        $query = $db->connect()->prepare("SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.user_id = account.account_id
                                INNER JOIN reviews ON job_application.application_id = reviews.application_id
                                WHERE job_application.freelance_id = :account_id AND job_application.jobstatus = 'COMPLETED' ORDER BY job_application.timestamp DESC");
                        $query->execute([':account_id' => $_SESSION['account_id']]);
                        foreach ($query as $row) {
                            echo '
                                <div class="parent">
                                    <div class="child left">
                                        <span class="name-info">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <span class="job-type">' . $row['post_title'] . '</span>
                                    </div>
                                    <div class="child right">
                                        <span class="status status-3">
                                        ' . $row['jobstatus'] .
                                '
                                        </span>
                                        <div class="mb-3">
                                            ';
                            for ($star = 1; $star <= 5; $star++) {
                                $class_name = '';

                                if ($row['rating'] >= $star) {
                                    $class_name = 'text-warning';
                                } else {
                                    $class_name = 'star-light';
                                }
                                echo
                                '<i class="fas fa-star ' . $class_name . ' mr-1"></i>';
                            }
                            echo '

                                            
                                        </div>
                                    </div>
                                </div>
                                ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>



<!-- MODAL FOR ViEW JOB APPLICATION -->
<div class="modal fade" id="modal-view-job-app" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> -->
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Job Application</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply">
                <form action="">

                    <div class="title mb-3">
                        <span class="label">Job Title:</span>
                        <span class="content" id="post_title">
                            Web Dev
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">To:</span>
                        <span class="content" id="from">
                            John Paulo Sulitz
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">Status:</span>
                        <span class="content" id="jobstatus">
                            Pending
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">Message:</span>
                        <p class="" id="from_message">

                        </p>
                    </div>

                    <div class="mb-3">
                        <!-- <label for="formFileSm" class="form-label label">Upload file</label>
                        <input class="form-control form-control-sm" id="formFileSm" type="file"> -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Send</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL FOR REPORTING -->
<div class="modal fade" id="report-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="modal fade" id="report-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Report Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reported User:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="@JPSulit" disabled>
                    </div>
                    <label for="sample-ss" class="col-form-label">Provide a Screenshot:</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="sample-ss">
                        <label class="input-group-text" for="sample-ss">Upload</label>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Reason for Report:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script src="../classJS/Job.js"></script>
<script src="../php/messaging/freelance-side/Message.js"></script>
<script src="../classJS/Account.js"></script>
<script src="../classJS/Notification.js"></script>
<script>
$(document).ready(function() {
    $('.tab_container:first').show();
    $('.tab_navigation li:first').addClass('active');

    $('.tab_navigation li').click(function(event) {
        index = $(this).index();
        $('.tab_navigation li').removeClass('active');
        $(this).addClass('active');
        $('.tab_container').hide();
        $('.tab_container').eq(index).show();
    });

});
</script>

</html>